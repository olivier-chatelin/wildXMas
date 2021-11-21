<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121211219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE default_reward (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE default_reward_reward (default_reward_id INT NOT NULL, reward_id INT NOT NULL, INDEX IDX_1A4A2FC475048406 (default_reward_id), INDEX IDX_1A4A2FC4E466ACA1 (reward_id), PRIMARY KEY(default_reward_id, reward_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE default_reward_reward ADD CONSTRAINT FK_1A4A2FC475048406 FOREIGN KEY (default_reward_id) REFERENCES default_reward (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE default_reward_reward ADD CONSTRAINT FK_1A4A2FC4E466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE default_reward_reward DROP FOREIGN KEY FK_1A4A2FC475048406');
        $this->addSql('DROP TABLE default_reward');
        $this->addSql('DROP TABLE default_reward_reward');
    }
}
