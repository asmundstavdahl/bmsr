<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180315131244 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE property (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, name CLOB NOT NULL, value CLOB NOT NULL, "order" INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8BF21CDEC54C8C93 ON property (type_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__thing AS SELECT id, type_id FROM thing');
        $this->addSql('DROP TABLE thing');
        $this->addSql('CREATE TABLE thing (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_5B4C2C83C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO thing (id, type_id) SELECT id, type_id FROM __temp__thing');
        $this->addSql('DROP TABLE __temp__thing');
        $this->addSql('CREATE INDEX IDX_5B4C2C83C54C8C93 ON thing (type_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE property');
        $this->addSql('DROP INDEX IDX_5B4C2C83C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__thing AS SELECT id, type_id FROM thing');
        $this->addSql('DROP TABLE thing');
        $this->addSql('CREATE TABLE thing (id INTEGER NOT NULL, type_id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO thing (id, type_id) SELECT id, type_id FROM __temp__thing');
        $this->addSql('DROP TABLE __temp__thing');
    }
}
