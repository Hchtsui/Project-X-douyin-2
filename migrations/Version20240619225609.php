<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619225609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_videos (categories_id INT NOT NULL, videos_id INT NOT NULL, INDEX IDX_21C35A0AA21214B7 (categories_id), INDEX IDX_21C35A0A763C10B2 (videos_id), PRIMARY KEY(categories_id, videos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videos (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, url VARCHAR(255) NOT NULL, tag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videos_tags (videos_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_CD9528D2763C10B2 (videos_id), INDEX IDX_CD9528D28D7B4FB4 (tags_id), PRIMARY KEY(videos_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0A763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videos_tags ADD CONSTRAINT FK_CD9528D2763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videos_tags ADD CONSTRAINT FK_CD9528D28D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0AA21214B7');
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0A763C10B2');
        $this->addSql('ALTER TABLE videos_tags DROP FOREIGN KEY FK_CD9528D2763C10B2');
        $this->addSql('ALTER TABLE videos_tags DROP FOREIGN KEY FK_CD9528D28D7B4FB4');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_videos');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE videos');
        $this->addSql('DROP TABLE videos_tags');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
