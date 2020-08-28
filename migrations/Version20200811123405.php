<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811123405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD figure_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A5C011B5 FOREIGN KEY (figure_id) REFERENCES figures (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A5C011B5 ON comments (figure_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A5C011B5');
        $this->addSql('DROP INDEX IDX_5F9E962A5C011B5 ON comments');
        $this->addSql('ALTER TABLE comments DROP figure_id');
    }
}
