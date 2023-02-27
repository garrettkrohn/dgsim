<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207144333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE Course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE archetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hole_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hole_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_update_logs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Course (id INT NOT NULL, name VARCHAR(50) NOT NULL, course_par INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE archetype (id INT NOT NULL, name VARCHAR(255) NOT NULL, min_putt_skill INT NOT NULL, min_throw_power_skill INT NOT NULL, min_throw_accuracy_skill INT NOT NULL, min_scramble_skill INT NOT NULL, max_putt_skill INT NOT NULL, max_throw_power_skill INT NOT NULL, max_throw_accuracy_skill INT NOT NULL, max_scramble_skill INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hole (id INT NOT NULL, course_id INT NOT NULL, par INT NOT NULL, parked_rate DOUBLE PRECISION NOT NULL, c1_rate DOUBLE PRECISION NOT NULL, c2_rate DOUBLE PRECISION NOT NULL, scramble_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_68CD3D91591CC992 ON hole (course_id)');
        $this->addSql('CREATE TABLE hole_result (id INT NOT NULL, round_id INT NOT NULL, score INT NOT NULL, c1_putts INT NOT NULL, c2_putts INT NOT NULL, green_in_regulation BOOLEAN NOT NULL, scramble BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F415BCEDA6005CA0 ON hole_result (round_id)');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, archetype_id INT NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, putt_skill INT NOT NULL, throw_power_skill INT NOT NULL, throw_accuracy_skill INT NOT NULL, scramble_skill INT NOT NULL, start_season INT NOT NULL, is_active BOOLEAN NOT NULL, banked_skill_points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98197A65732C6CC7 ON player (archetype_id)');
        $this->addSql('CREATE TABLE player_update_logs (id INT NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, player_id INT NOT NULL, putt_increment INT NOT NULL, throw_power_increment INT NOT NULL, throw_accuracy_increment INT NOT NULL, scramble_increment INT NOT NULL, previous_bank INT NOT NULL, post_bank INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, player_id INT NOT NULL, course_id INT NOT NULL, round_hole_result_id INT NOT NULL, round_total INT NOT NULL, luck_score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5EEEA3499E6F5DF ON round (player_id)');
        $this->addSql('CREATE TABLE tournament (id INT NOT NULL, course_id INT NOT NULL, name VARCHAR(50) NOT NULL, winner INT NOT NULL, season INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9591CC992 ON tournament (course_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, role_id INT NOT NULL, user_id INT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('CREATE TABLE user_player (id INT NOT NULL, user_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD4B6158A76ED395 ON user_player (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD4B615899E6F5DF ON user_player (player_id)');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT FK_68CD3D91591CC992 FOREIGN KEY (course_id) REFERENCES Course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hole_result ADD CONSTRAINT FK_F415BCEDA6005CA0 FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65732C6CC7 FOREIGN KEY (archetype_id) REFERENCES archetype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA3499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9591CC992 FOREIGN KEY (course_id) REFERENCES Course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B6158A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player ADD CONSTRAINT FK_FD4B615899E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE archetype_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hole_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hole_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_update_logs_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tournament_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_player_id_seq CASCADE');
        $this->addSql('ALTER TABLE hole DROP CONSTRAINT FK_68CD3D91591CC992');
        $this->addSql('ALTER TABLE hole_result DROP CONSTRAINT FK_F415BCEDA6005CA0');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65732C6CC7');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA3499E6F5DF');
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT FK_BD5FB8D9591CC992');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B6158A76ED395');
        $this->addSql('ALTER TABLE user_player DROP CONSTRAINT FK_FD4B615899E6F5DF');
        $this->addSql('DROP TABLE Course');
        $this->addSql('DROP TABLE archetype');
        $this->addSql('DROP TABLE hole');
        $this->addSql('DROP TABLE hole_result');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_update_logs');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_player');
    }
}
