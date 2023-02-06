<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206170150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, player_id INT NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, putt_skill INT NOT NULL, throw_power_skill INT NOT NULL, throw_accuracy_skill INT NOT NULL, scramble_skill INT NOT NULL, start_season INT NOT NULL, is_active BOOLEAN NOT NULL, banked_skill_points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, role_id_id INT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_57698A6A88987678 ON role (role_id_id)');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, player_id INT NOT NULL, course_id INT NOT NULL, round_hole_result_id INT NOT NULL, round_total INT NOT NULL, luck_score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5EEEA3499E6F5DF ON round (player_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, user_id INT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_player (id INT NOT NULL, user_id_id INT NOT NULL, player_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD4B61589D86650F ON user_player (user_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD4B6158C036E511 ON user_player (player_id_id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A88987678 FOREIGN KEY (role_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B61589D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B6158C036E511 FOREIGN KEY (player_id_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_player_id_seq CASCADE');
        $this->addSql('ALTER TABLE role DROP CONSTRAINT FK_57698A6A88987678');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA3499E6F5DF');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B61589D86650F');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B6158C036E511');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_player');
    }
}
