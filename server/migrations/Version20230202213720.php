<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202213720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE archetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hole_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hole_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_update_logs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE archetype (id INT NOT NULL, archetype_id INT NOT NULL, name VARCHAR(25) NOT NULL, min_putt_skill INT NOT NULL, min_throw_power_skill INT NOT NULL, min_throw_accuracy_skill INT NOT NULL, min_scramble_skill INT NOT NULL, max_putt_skill INT NOT NULL, max_throw_power_skill INT NOT NULL, max_throw_accuracy_skill INT NOT NULL, max_scramble_skill INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, course_id INT NOT NULL, name VARCHAR(25) NOT NULL, course_par INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hole (id INT NOT NULL, hole_id INT NOT NULL, par INT NOT NULL, parked_rate DOUBLE PRECISION NOT NULL, c1_rate DOUBLE PRECISION NOT NULL, c2_rate DOUBLE PRECISION NOT NULL, scramble_rate DOUBLE PRECISION NOT NULL, course_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hole_result (id INT NOT NULL, hole_result_id INT NOT NULL, score INT NOT NULL, c1_putts INT DEFAULT NULL, c2_putts INT DEFAULT NULL, green_in_regulation BOOLEAN DEFAULT NULL, scramble BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, player_id INT NOT NULL, first_name VARCHAR(25) NOT NULL, last_name VARCHAR(25) NOT NULL, putt_skill INT NOT NULL, throw_power_skill INT NOT NULL, throw_accuracy_skill INT NOT NULL, scramble_skill INT NOT NULL, start_season INT NOT NULL, active BOOLEAN NOT NULL, archetype_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE player_update_logs (id INT NOT NULL, player_update_logs_id INT NOT NULL, update_time TIME(0) WITHOUT TIME ZONE NOT NULL, player_id INT NOT NULL, putt_increment INT NOT NULL, throw_power_increment INT NOT NULL, throw_accuracy_increment INT NOT NULL, scramble_increment INT NOT NULL, previous_bank INT NOT NULL, post_bank INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, round_id INT NOT NULL, player_id INT NOT NULL, course_id INT NOT NULL, round_hole_result_id INT NOT NULL, round_total INT NOT NULL, luck_score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tournament (id INT NOT NULL, tournament_id INT NOT NULL, name VARCHAR(50) NOT NULL, winner INT NOT NULL, season INT NOT NULL, course_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, user_id INT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(20) NOT NULL, user_type_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_player (id INT NOT NULL, user_player_id INT NOT NULL, user_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_type (id INT NOT NULL, user_type_id INT NOT NULL, user_type VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE archetype_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hole_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hole_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_update_logs_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tournament_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_type_id_seq CASCADE');
        $this->addSql('DROP TABLE archetype');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE hole');
        $this->addSql('DROP TABLE hole_result');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_update_logs');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_player');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
