<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619104959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_videos DROP FOREIGN KEY FK_4CF87F0F763C10B2');
        $this->addSql('ALTER TABLE user_videos DROP FOREIGN KEY FK_4CF87F0FA76ED395');
        $this->addSql('DROP TABLE user_videos');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_videos (user_id INT NOT NULL, videos_id INT NOT NULL, INDEX IDX_4CF87F0FA76ED395 (user_id), INDEX IDX_4CF87F0F763C10B2 (videos_id), PRIMARY KEY(user_id, videos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_videos ADD CONSTRAINT FK_4CF87F0F763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_videos ADD CONSTRAINT FK_4CF87F0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
