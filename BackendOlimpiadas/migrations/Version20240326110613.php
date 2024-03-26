<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326110613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usuarios_meses (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, mes1 INT NOT NULL, mes2 INT NOT NULL, UNIQUE INDEX UNIQ_547E76C07EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuarios_meses ADD CONSTRAINT FK_547E76C07EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuarios_meses DROP FOREIGN KEY FK_547E76C07EB2C349');
        $this->addSql('DROP TABLE usuarios_meses');
    }
}
