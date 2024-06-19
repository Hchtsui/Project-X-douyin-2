<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619112316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE videos_tags (videos_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_CD9528D2763C10B2 (videos_id), INDEX IDX_CD9528D28D7B4FB4 (tags_id), PRIMARY KEY(videos_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE videos_tags ADD CONSTRAINT FK_CD9528D2763C10B2 FOREIGN KEY (videos_id) REFERENCES videos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videos_tags ADD CONSTRAINT FK_CD9528D28D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags CHANGE tags name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE videos_tags DROP FOREIGN KEY FK_CD9528D2763C10B2');
        $this->addSql('ALTER TABLE videos_tags DROP FOREIGN KEY FK_CD9528D28D7B4FB4');
        $this->addSql('DROP TABLE videos_tags');
        $this->addSql('ALTER TABLE tags CHANGE name tags VARCHAR(255) NOT NULL');
    }
}
