<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617162140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meuble (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meuble_category (meuble_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_A1AA6B88E1780C00 (meuble_id), INDEX IDX_A1AA6B8812469DE2 (category_id), PRIMARY KEY(meuble_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meuble_category ADD CONSTRAINT FK_A1AA6B88E1780C00 FOREIGN KEY (meuble_id) REFERENCES meuble (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meuble_category ADD CONSTRAINT FK_A1AA6B8812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meuble_category DROP FOREIGN KEY FK_A1AA6B88E1780C00');
        $this->addSql('DROP TABLE meuble');
        $this->addSql('DROP TABLE meuble_category');
    }
}
