<?php

namespace App\Command\Update;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Console\Helper\ProgressBar;

#[AsCommand(name: 'app:update-card')]
class UpdateCardCommand extends Command
{

    private EntityManagerInterface $em;
    private HttpClientInterface $client;
    private LoggerInterface $logger;
    public function __construct(EntityManagerInterface $em, HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->client = $client;
        $this->logger = $logger;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cards = $this->em->getRepository(Card::class)->findAll();
        $progressBar = new ProgressBar($output, count($cards));
        $errorCount = 0;

        foreach ($cards as $card) {
            try {
                $response = $this->client->request('GET', "https://api.pokemontcg.io/v2/cards/{$card->getTcgId()}", [
                    'headers' => [
                        'X-Api-Key' => "23bb3d4f-c272-4e2f-b922-421a77e716ba"
                    ]
                ]);
                if ($card->isIsHolo() === false || $card->isIsHolo() === null) {
                    $card->setAvg1Price($response->toArray()['data']['cardmarket']['prices']['avg1']);
                }
                $card->setCardMarketUrl($response->toArray()['data']['cardmarket']['url']);

//                $this->logger->warning("Processed card with TCG ID: {$card->getTcgId()}");

            } catch (\Exception $e) {
                $this->logger->error("Error processing card with TCG ID: {$card->getTcgId()}. Error: {$e->getMessage()}");
                $errorCount++;
            }
            $progressBar->advance();
        }
        $output->writeln("\nTotal errors: $errorCount");
        $this->logger->info("Total errors: $errorCount");

        $this->em->flush();
        return Command::SUCCESS;
    }

}
