<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215145110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hole DROP CONSTRAINT fk_68cd3d91e2d68368');
        $this->addSql('DROP INDEX idx_68cd3d91e2d68368');
        $this->addSql('ALTER TABLE hole DROP hole_result_id');
        $this->addSql('ALTER TABLE hole_result ADD hole_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hole_result ADD CONSTRAINT FK_F415BCED15ADE12C FOREIGN KEY (hole_id) REFERENCES hole (hole_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F415BCED15ADE12C ON hole_result (hole_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hole ADD hole_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT fk_68cd3d91e2d68368 FOREIGN KEY (hole_result_id) REFERENCES hole_result (hole_result_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_68cd3d91e2d68368 ON hole (hole_result_id)');
        $this->addSql('ALTER TABLE hole_result DROP CONSTRAINT FK_F415BCED15ADE12C');
        $this->addSql('DROP INDEX IDX_F415BCED15ADE12C');
        $this->addSql('ALTER TABLE hole_result DROP hole_id');
    }
}
