<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213213701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hole_result ADD c1_in_regulation BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE hole_result ADD c2_in_regulation BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE hole_result RENAME COLUMN green_in_regulation TO parked');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hole_result ADD green_in_regulation BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE hole_result DROP parked');
        $this->addSql('ALTER TABLE hole_result DROP c1_in_regulation');
        $this->addSql('ALTER TABLE hole_result DROP c2_in_regulation');
    }
}
