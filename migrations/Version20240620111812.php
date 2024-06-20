<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620111812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_category (videos_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_AECE2B7D763C10B2 (videos_id), INDEX IDX_AECE2B7DA21214B7 (categories_id), PRIMARY KEY(videos_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_category ADD CONSTRAINT FK_AECE2B7D763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_category ADD CONSTRAINT FK_AECE2B7DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0A763C10B2');
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0AA21214B7');
        $this->addSql('DROP TABLE categories_videos');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_videos (categories_id INT NOT NULL, videos_id INT NOT NULL, INDEX IDX_21C35A0A763C10B2 (videos_id), INDEX IDX_21C35A0AA21214B7 (categories_id), PRIMARY KEY(categories_id, videos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0A763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_category DROP FOREIGN KEY FK_AECE2B7D763C10B2');
        $this->addSql('ALTER TABLE video_category DROP FOREIGN KEY FK_AECE2B7DA21214B7');
        $this->addSql('DROP TABLE video_category');
    }
}
