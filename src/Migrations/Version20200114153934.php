<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114153934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_customer_id INT DEFAULT NULL, id_place_id INT DEFAULT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_FE38F84479F37AE5 (id_user_id), UNIQUE INDEX UNIQ_FE38F8448B870E04 (id_customer_id), UNIQUE INDEX UNIQ_FE38F8445D7D4E8C (id_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8448B870E04 FOREIGN KEY (id_customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8445D7D4E8C FOREIGN KEY (id_place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE customer CHANGE birthdate birthdate DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE appointment');
        $this->addSql('ALTER TABLE customer CHANGE birthdate birthdate VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
