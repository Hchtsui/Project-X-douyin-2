<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619105431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_videos (categories_id INT NOT NULL, videos_id INT NOT NULL, INDEX IDX_21C35A0AA21214B7 (categories_id), INDEX IDX_21C35A0A763C10B2 (videos_id), PRIMARY KEY(categories_id, videos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_videos ADD CONSTRAINT FK_21C35A0A763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0AA21214B7');
        $this->addSql('ALTER TABLE categories_videos DROP FOREIGN KEY FK_21C35A0A763C10B2');
        $this->addSql('DROP TABLE categories_videos');
    }
}
