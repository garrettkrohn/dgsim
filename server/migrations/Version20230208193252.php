<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208193252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE hole_result DROP CONSTRAINT FK_F415BCEDA6005CA0');
        $this->addSql('ALTER TABLE player RENAME COLUMN id TO player_id');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA3499E6F5DF');
        $this->addSql('ALTER TABLE round RENAME COLUMN id TO round_id');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3499E6F5DF FOREIGN KEY (player_id) REFERENCES player (player_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B615899E6F5DF');
        $this->addSql('ALTER TABLE user_player ALTER player_id DROP NOT NULL');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B615899E6F5DF FOREIGN KEY (player_id) REFERENCES player (player_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hole_result ADD CONSTRAINT FK_F415BCEDA6005CA0 FOREIGN KEY (round_id) REFERENCES round (round_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_round_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE hole_result DROP CONSTRAINT fk_f415bceda6005ca0');
        $this->addSql('ALTER TABLE hole_result ALTER round_id SET NOT NULL');
        $this->addSql('ALTER TABLE hole_result ADD CONSTRAINT fk_f415bceda6005ca0 FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX player_pkey');
        $this->addSql('ALTER TABLE player RENAME COLUMN player_id TO id');
        $this->addSql('ALTER TABLE player ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT fk_c5eeea3499e6f5df');
        $this->addSql('DROP INDEX round_pkey');
        $this->addSql('ALTER TABLE round RENAME COLUMN round_id TO id');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT fk_c5eeea3499e6f5df FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT fk_fd4b615899e6f5df');
        $this->addSql('ALTER TABLE user_player ALTER player_id SET NOT NULL');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT fk_fd4b615899e6f5df FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
