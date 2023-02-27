<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208195003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "user_user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN id TO user_id');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B6158A76ED395');
        $this->addSql('ALTER TABLE user_player ALTER user_id DROP NOT NULL');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B6158A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "user_user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX user_pkey');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN user_id TO id');
        $this->addSql('ALTER TABLE "user" ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT fk_fd4b6158a76ed395');
        $this->addSql('ALTER TABLE user_player ALTER user_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT fk_fd4b6158a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
