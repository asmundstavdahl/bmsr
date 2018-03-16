<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316150536 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE thing_value (id INTEGER NOT NULL, property_id INTEGER DEFAULT NULL, thing_id INTEGER DEFAULT NULL, value CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA71360F549213EC ON thing_value (property_id)');
        $this->addSql('CREATE INDEX IDX_BA71360FC36906A7 ON thing_value (thing_id)');
        $this->addSql('DROP INDEX IDX_8BF21CDEC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, type_id, name, value, "order" FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, name CLOB NOT NULL COLLATE BINARY, default_value CLOB NOT NULL, sortnum INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_8BF21CDEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO property (id, type_id, name, default_value, sortnum) SELECT id, type_id, name, value, "order" FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
        $this->addSql('CREATE INDEX IDX_8BF21CDEC54C8C93 ON property (type_id)');
        $this->addSql('DROP INDEX IDX_5B4C2C83C54C8C93');
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

        $this->addSql('DROP TABLE thing_value');
        $this->addSql('DROP INDEX IDX_8BF21CDEC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, type_id, name, default_value, sortnum FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, name CLOB NOT NULL, value CLOB NOT NULL COLLATE BINARY, "order" INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO property (id, type_id, name, value, "order") SELECT id, type_id, name, default_value, sortnum FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
        $this->addSql('CREATE INDEX IDX_8BF21CDEC54C8C93 ON property (type_id)');
        $this->addSql('DROP INDEX IDX_5B4C2C83C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__thing AS SELECT id, type_id FROM thing');
        $this->addSql('DROP TABLE thing');
        $this->addSql('CREATE TABLE thing (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO thing (id, type_id) SELECT id, type_id FROM __temp__thing');
        $this->addSql('DROP TABLE __temp__thing');
        $this->addSql('CREATE INDEX IDX_5B4C2C83C54C8C93 ON thing (type_id)');
    }
}
