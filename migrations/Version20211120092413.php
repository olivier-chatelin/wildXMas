<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120092413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE available_days (id INT AUTO_INCREMENT NOT NULL, dateset LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instructor (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_remote TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_31FC43DDE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instructor_reward (instructor_id INT NOT NULL, reward_id INT NOT NULL, INDEX IDX_3169AD0F8C4FC193 (instructor_id), INDEX IDX_3169AD0FE466ACA1 (reward_id), PRIMARY KEY(instructor_id, reward_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reward (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, is_good TINYINT(1) NOT NULL, is_remote_friendly TINYINT(1) NOT NULL, scheduled_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, instructor_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_B723AF338C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_reward (student_id INT NOT NULL, reward_id INT NOT NULL, INDEX IDX_C0E7AAD3CB944F1A (student_id), INDEX IDX_C0E7AAD3E466ACA1 (reward_id), PRIMARY KEY(student_id, reward_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instructor_reward ADD CONSTRAINT FK_3169AD0F8C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instructor_reward ADD CONSTRAINT FK_3169AD0FE466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF338C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id)');
        $this->addSql('ALTER TABLE student_reward ADD CONSTRAINT FK_C0E7AAD3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_reward ADD CONSTRAINT FK_C0E7AAD3E466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instructor_reward DROP FOREIGN KEY FK_3169AD0F8C4FC193');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF338C4FC193');
        $this->addSql('ALTER TABLE instructor_reward DROP FOREIGN KEY FK_3169AD0FE466ACA1');
        $this->addSql('ALTER TABLE student_reward DROP FOREIGN KEY FK_C0E7AAD3E466ACA1');
        $this->addSql('ALTER TABLE student_reward DROP FOREIGN KEY FK_C0E7AAD3CB944F1A');
        $this->addSql('DROP TABLE available_days');
        $this->addSql('DROP TABLE instructor');
        $this->addSql('DROP TABLE instructor_reward');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_reward');
    }
}
