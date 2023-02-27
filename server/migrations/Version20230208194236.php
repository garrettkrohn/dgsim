<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208194236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_player_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE Course_course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_player_user_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE course RENAME COLUMN id TO course_id');
        $this->addSql('ALTER TABLE hole DROP CONSTRAINT FK_68CD3D91591CC992');
        $this->addSql('ALTER TABLE hole ALTER course_id DROP NOT NULL');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT FK_68CD3D91591CC992 FOREIGN KEY (course_id) REFERENCES Course (course_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT FK_BD5FB8D9591CC992');
        $this->addSql('ALTER TABLE tournament ALTER course_id DROP NOT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9591CC992 FOREIGN KEY (course_id) REFERENCES Course (course_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_player RENAME COLUMN id TO user_player_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Course_course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_player_user_player_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT fk_bd5fb8d9591cc992');
        $this->addSql('ALTER TABLE tournament ALTER course_id SET NOT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT fk_bd5fb8d9591cc992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX course_pkey');
        $this->addSql('ALTER TABLE Course RENAME COLUMN course_id TO id');
        $this->addSql('ALTER TABLE Course ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX user_player_pkey');
        $this->addSql('ALTER TABLE user_player RENAME COLUMN user_player_id TO id');
        $this->addSql('ALTER TABLE user_player ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE hole DROP CONSTRAINT fk_68cd3d91591cc992');
        $this->addSql('ALTER TABLE hole ALTER course_id SET NOT NULL');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT fk_68cd3d91591cc992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
