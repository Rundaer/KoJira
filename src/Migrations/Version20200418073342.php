<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418073342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, roles CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO user (id, username, roles, password) SELECT id, username, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP INDEX IDX_5F9E962A8DB60186');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, task_id, comment, created_at FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, task_id INTEGER DEFAULT NULL, comment VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, CONSTRAINT FK_5F9E962A8DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comments (id, task_id, comment, created_at) SELECT id, task_id, comment, created_at FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962A8DB60186 ON comments (task_id)');
        $this->addSql('DROP INDEX IDX_50586597166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tasks AS SELECT id, project_id, title, description, created_at, updated_at, status FROM tasks');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('CREATE TABLE tasks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status VARCHAR(50) NOT NULL COLLATE BINARY, CONSTRAINT FK_50586597166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tasks (id, project_id, title, description, created_at, updated_at, status) SELECT id, project_id, title, description, created_at, updated_at, status FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597166D1F9C ON tasks (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_5F9E962A8DB60186');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, task_id, comment, created_at FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, task_id INTEGER DEFAULT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO comments (id, task_id, comment, created_at) SELECT id, task_id, comment, created_at FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962A8DB60186 ON comments (task_id)');
        $this->addSql('DROP INDEX IDX_50586597166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tasks AS SELECT id, project_id, title, description, created_at, updated_at, status FROM tasks');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('CREATE TABLE tasks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status VARCHAR(50) NOT NULL)');
        $this->addSql('INSERT INTO tasks (id, project_id, title, description, created_at, updated_at, status) SELECT id, project_id, title, description, created_at, updated_at, status FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597166D1F9C ON tasks (project_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO user (id, username, roles, password) SELECT id, username, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
