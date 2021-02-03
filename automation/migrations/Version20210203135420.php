<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203135420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE environment (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(30) NOT NULL, branch VARCHAR(30) NOT NULL, release_prefix VARCHAR(30) NOT NULL, update_prefix VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE php_updates (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', php_version_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', release_version VARCHAR(8) NOT NULL, package_hash VARCHAR(64) NOT NULL, revision_version INT NOT NULL, type VARCHAR(30) NOT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', branch VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F314496A81E24D4 (php_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE php_version (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', enviroment_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', minor_version VARCHAR(4) NOT NULL, current_release_version VARCHAR(8) NOT NULL, status VARCHAR(30) NOT NULL, INDEX IDX_9408999D8372F9E (enviroment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(30) NOT NULL, ci_cd VARCHAR(30) NOT NULL, image_name VARCHAR(30) NOT NULL, status VARCHAR(30) NOT NULL, os VARCHAR(22) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform_update (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', parent_update_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', platform_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', bottle_hash VARCHAR(64) DEFAULT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_72C22E2524DDC55F (parent_update_id), INDEX IDX_72C22E25FFE6496F (platform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE php_updates ADD CONSTRAINT FK_F314496A81E24D4 FOREIGN KEY (php_version_id) REFERENCES php_version (id)');
        $this->addSql('ALTER TABLE php_version ADD CONSTRAINT FK_9408999D8372F9E FOREIGN KEY (enviroment_id) REFERENCES environment (id)');
        $this->addSql('ALTER TABLE platform_update ADD CONSTRAINT FK_72C22E2524DDC55F FOREIGN KEY (parent_update_id) REFERENCES php_updates (id)');
        $this->addSql('ALTER TABLE platform_update ADD CONSTRAINT FK_72C22E25FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE php_version DROP FOREIGN KEY FK_9408999D8372F9E');
        $this->addSql('ALTER TABLE platform_update DROP FOREIGN KEY FK_72C22E2524DDC55F');
        $this->addSql('ALTER TABLE php_updates DROP FOREIGN KEY FK_F314496A81E24D4');
        $this->addSql('ALTER TABLE platform_update DROP FOREIGN KEY FK_72C22E25FFE6496F');
        $this->addSql('DROP TABLE environment');
        $this->addSql('DROP TABLE php_updates');
        $this->addSql('DROP TABLE php_version');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE platform_update');
    }
}
