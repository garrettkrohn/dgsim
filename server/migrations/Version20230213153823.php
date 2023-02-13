<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213153823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE player_tournament_player_tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player_tournament (player_tournament_id INT NOT NULL, tour_points INT NOT NULL, PRIMARY KEY(player_tournament_id))');
        $this->addSql('ALTER TABLE player ADD player_tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E631DF53 FOREIGN KEY (player_tournament_id) REFERENCES player_tournament (player_tournament_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_98197A65E631DF53 ON player (player_tournament_id)');
        $this->addSql('ALTER TABLE round ADD player_tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA34E631DF53 FOREIGN KEY (player_tournament_id) REFERENCES player_tournament (player_tournament_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C5EEEA34E631DF53 ON round (player_tournament_id)');
        $this->addSql('ALTER TABLE tournament DROP winner');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65E631DF53');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA34E631DF53');
        $this->addSql('DROP SEQUENCE player_tournament_player_tournament_id_seq CASCADE');
        $this->addSql('DROP TABLE player_tournament');
        $this->addSql('ALTER TABLE tournament ADD winner INT NOT NULL');
        $this->addSql('DROP INDEX IDX_98197A65E631DF53');
        $this->addSql('ALTER TABLE player DROP player_tournament_id');
        $this->addSql('DROP INDEX IDX_C5EEEA34E631DF53');
        $this->addSql('ALTER TABLE round DROP player_tournament_id');
    }
}
