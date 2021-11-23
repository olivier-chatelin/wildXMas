<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123215454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE csv_file DROP FOREIGN KEY FK_2C25ED4D8C4FC193');
        $this->addSql('DROP INDEX UNIQ_2C25ED4D8C4FC193 ON csv_file');
        $this->addSql('ALTER TABLE csv_file DROP instructor_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE csv_file ADD instructor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE csv_file ADD CONSTRAINT FK_2C25ED4D8C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C25ED4D8C4FC193 ON csv_file (instructor_id)');
    }
}
