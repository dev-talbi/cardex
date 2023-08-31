<?php

namespace App\Command;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:card-migration')]
class CardMigration extends Command
{

    public function __construct(
        private EntityManagerInterface $em,
        private HttpClientInterface $client
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '512M'); // Augmenter à 512 Mo
        $cardRepo = $this->em->getRepository(Card::class);
        $response = $this->client->request('GET', 'https://api.pokemontcg.io/v2/cards?page=1&pageSize=1', [
            'headers' => [
                'X-Api-Key' => "23bb3d4f-c272-4e2f-b922-421a77e716ba"
            ]
        ]);

        $data = $response->toArray();

        $totalCount = $data['totalCount'];
        $numberOfPages = (int) ceil($totalCount / 250);

        for ($i =1 ; $i <= $numberOfPages ; $i++) {
            $cards = $this->client->request('GET', "https://api.pokemontcg.io/v2/cards?page={$i}", [
                'headers' => [
                    'X-Api-Key' => "23bb3d4f-c272-4e2f-b922-421a77e716ba"
                ]
            ]);

            foreach ($cards->toArray()['data'] as $card){
                $saveCard = new Card();
                $saveCard->setName($card['name'])
                    ->setTcgId($card['id']);

                $this->em->persist($saveCard);
            }
            $this->em->flush();
            $this->em->clear();
        }


        return Command::SUCCESS;
    }

}
