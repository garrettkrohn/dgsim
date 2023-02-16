<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216144956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP CONSTRAINT fk_98197a65e631df53');
        $this->addSql('DROP INDEX idx_98197a65e631df53');
        $this->addSql('ALTER TABLE player DROP player_tournament_id');
        $this->addSql('ALTER TABLE player_tournament ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player_tournament ADD CONSTRAINT FK_E2FA3CE499E6F5DF FOREIGN KEY (player_id) REFERENCES player (player_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E2FA3CE499E6F5DF ON player_tournament (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player ADD player_tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_98197a65e631df53 FOREIGN KEY (player_tournament_id) REFERENCES player_tournament (player_tournament_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_98197a65e631df53 ON player (player_tournament_id)');
        $this->addSql('ALTER TABLE player_tournament DROP CONSTRAINT FK_E2FA3CE499E6F5DF');
        $this->addSql('DROP INDEX IDX_E2FA3CE499E6F5DF');
        $this->addSql('ALTER TABLE player_tournament DROP player_id');
    }
}
