<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123222621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instructor ADD csv_file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instructor ADD CONSTRAINT FK_31FC43DDBED78269 FOREIGN KEY (csv_file_id) REFERENCES csv_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_31FC43DDBED78269 ON instructor (csv_file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instructor DROP FOREIGN KEY FK_31FC43DDBED78269');
        $this->addSql('DROP INDEX UNIQ_31FC43DDBED78269 ON instructor');
        $this->addSql('ALTER TABLE instructor DROP csv_file_id');
    }
}
