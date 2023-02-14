<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214170453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hole ADD hole_result_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hole ADD CONSTRAINT FK_68CD3D91E2D68368 FOREIGN KEY (hole_result_id) REFERENCES hole_result (hole_result_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68CD3D91E2D68368 ON hole (hole_result_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hole DROP CONSTRAINT FK_68CD3D91E2D68368');
        $this->addSql('DROP INDEX IDX_68CD3D91E2D68368');
        $this->addSql('ALTER TABLE hole DROP hole_result_id');
    }
}
