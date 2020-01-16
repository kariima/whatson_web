<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115095101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8445D7D4E8C');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84479F37AE5');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8448B870E04');
        $this->addSql('DROP INDEX UNIQ_FE38F8445D7D4E8C ON appointment');
        $this->addSql('DROP INDEX UNIQ_FE38F84479F37AE5 ON appointment');
        $this->addSql('DROP INDEX UNIQ_FE38F8448B870E04 ON appointment');
        $this->addSql('ALTER TABLE appointment ADD user_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL, ADD place_id INT DEFAULT NULL, DROP id_user_id, DROP id_customer_id, DROP id_place_id');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('CREATE INDEX IDX_FE38F844A76ED395 ON appointment (user_id)');
        $this->addSql('CREATE INDEX IDX_FE38F8449395C3F3 ON appointment (customer_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844DA6A219 ON appointment (place_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844A76ED395');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8449395C3F3');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844DA6A219');
        $this->addSql('DROP INDEX IDX_FE38F844A76ED395 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F8449395C3F3 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F844DA6A219 ON appointment');
        $this->addSql('ALTER TABLE appointment ADD id_user_id INT DEFAULT NULL, ADD id_customer_id INT DEFAULT NULL, ADD id_place_id INT DEFAULT NULL, DROP user_id, DROP customer_id, DROP place_id');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8445D7D4E8C FOREIGN KEY (id_place_id) REFERENCES place (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8448B870E04 FOREIGN KEY (id_customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F8445D7D4E8C ON appointment (id_place_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F84479F37AE5 ON appointment (id_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F8448B870E04 ON appointment (id_customer_id)');
    }
}
