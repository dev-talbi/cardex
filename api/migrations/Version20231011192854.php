<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011192854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card ADD is_holo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD is_reverse_holo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD card_market_day_price INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE card DROP is_holo');
        $this->addSql('ALTER TABLE card DROP is_reverse_holo');
        $this->addSql('ALTER TABLE card DROP card_market_day_price');
    }
}
