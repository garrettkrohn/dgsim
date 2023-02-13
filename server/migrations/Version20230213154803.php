<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213154803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_tournament ADD tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player_tournament ADD CONSTRAINT FK_E2FA3CE433D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (tournament_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E2FA3CE433D1A3E7 ON player_tournament (tournament_id)');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT fk_c5eeea3499e6f5df');
        $this->addSql('DROP INDEX idx_c5eeea3499e6f5df');
        $this->addSql('ALTER TABLE round DROP player_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player_tournament DROP CONSTRAINT FK_E2FA3CE433D1A3E7');
        $this->addSql('DROP INDEX IDX_E2FA3CE433D1A3E7');
        $this->addSql('ALTER TABLE player_tournament DROP tournament_id');
        $this->addSql('ALTER TABLE round ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT fk_c5eeea3499e6f5df FOREIGN KEY (player_id) REFERENCES player (player_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c5eeea3499e6f5df ON round (player_id)');
    }
}
