<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211161717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_empresas');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_empresas (user_id INT NOT NULL, empresas_id INT NOT NULL, INDEX IDX_9050ADA5602B00EE (empresas_id), INDEX IDX_9050ADA5A76ED395 (user_id), PRIMARY KEY(user_id, empresas_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_empresas ADD CONSTRAINT FK_9050ADA5602B00EE FOREIGN KEY (empresas_id) REFERENCES empresas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_empresas ADD CONSTRAINT FK_9050ADA5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
