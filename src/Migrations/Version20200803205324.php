<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803205324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, acheteur_id INT NOT NULL, annonce_id INT NOT NULL, startdate DATETIME NOT NULL, end_date DATETIME NOT NULL, created_at DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_26A9845696A7BB5F (acheteur_id), INDEX IDX_26A984568805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845696A7BB5F FOREIGN KEY (acheteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984568805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achat');
    }
}
