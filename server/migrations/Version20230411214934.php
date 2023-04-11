<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411214934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD background_color VARCHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD foreground_color VARCHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD avatar_background_color VARCHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD avatar_text_color VARCHAR(7) DEFAULT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP background_color');
        $this->addSql('ALTER TABLE "user" DROP foreground_color');
        $this->addSql('ALTER TABLE "user" DROP avatar_background_color');
        $this->addSql('ALTER TABLE "user" DROP avatar_text_color');
    }
}
