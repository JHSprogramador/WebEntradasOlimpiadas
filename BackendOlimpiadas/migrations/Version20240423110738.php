<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423110738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deportes (id INT AUTO_INCREMENT NOT NULL, nombre_deporte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrada (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, id_seccion_evento_id INT DEFAULT NULL, id_transaccion_id INT DEFAULT NULL, INDEX IDX_C949A2747EB2C349 (id_usuario_id), INDEX IDX_C949A27417A0767C (id_seccion_evento_id), INDEX IDX_C949A274B0DFD449 (id_transaccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estadios (id INT AUTO_INCREMENT NOT NULL, nombre_estadio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eventos (id INT AUTO_INCREMENT NOT NULL, nombre_evento VARCHAR(255) NOT NULL, periodo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eventos_deportes (eventos_id INT NOT NULL, deportes_id INT NOT NULL, INDEX IDX_FDBC7DD87F243861 (eventos_id), INDEX IDX_FDBC7DD81F308F18 (deportes_id), PRIMARY KEY(eventos_id, deportes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seccion_evento (id INT AUTO_INCREMENT NOT NULL, id_seccion_id INT DEFAULT NULL, id_evento_id INT DEFAULT NULL, precio DOUBLE PRECISION NOT NULL, INDEX IDX_8A03286BDFD0C1ED (id_seccion_id), INDEX IDX_8A03286B7904465 (id_evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secciones (id INT AUTO_INCREMENT NOT NULL, id_estadio_id INT DEFAULT NULL, aforo INT NOT NULL, nombre_seccion VARCHAR(255) NOT NULL, INDEX IDX_E7BAC5CA4039A3B9 (id_estadio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaxxiones (id INT AUTO_INCREMENT NOT NULL, fecha_transaccion DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A2747EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A27417A0767C FOREIGN KEY (id_seccion_evento_id) REFERENCES seccion_evento (id)');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A274B0DFD449 FOREIGN KEY (id_transaccion_id) REFERENCES transaxxiones (id)');
        $this->addSql('ALTER TABLE eventos_deportes ADD CONSTRAINT FK_FDBC7DD87F243861 FOREIGN KEY (eventos_id) REFERENCES eventos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventos_deportes ADD CONSTRAINT FK_FDBC7DD81F308F18 FOREIGN KEY (deportes_id) REFERENCES deportes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seccion_evento ADD CONSTRAINT FK_8A03286BDFD0C1ED FOREIGN KEY (id_seccion_id) REFERENCES secciones (id)');
        $this->addSql('ALTER TABLE seccion_evento ADD CONSTRAINT FK_8A03286B7904465 FOREIGN KEY (id_evento_id) REFERENCES eventos (id)');
        $this->addSql('ALTER TABLE secciones ADD CONSTRAINT FK_E7BAC5CA4039A3B9 FOREIGN KEY (id_estadio_id) REFERENCES estadios (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A2747EB2C349');
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A27417A0767C');
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A274B0DFD449');
        $this->addSql('ALTER TABLE eventos_deportes DROP FOREIGN KEY FK_FDBC7DD87F243861');
        $this->addSql('ALTER TABLE eventos_deportes DROP FOREIGN KEY FK_FDBC7DD81F308F18');
        $this->addSql('ALTER TABLE seccion_evento DROP FOREIGN KEY FK_8A03286BDFD0C1ED');
        $this->addSql('ALTER TABLE seccion_evento DROP FOREIGN KEY FK_8A03286B7904465');
        $this->addSql('ALTER TABLE secciones DROP FOREIGN KEY FK_E7BAC5CA4039A3B9');
        $this->addSql('DROP TABLE deportes');
        $this->addSql('DROP TABLE entrada');
        $this->addSql('DROP TABLE estadios');
        $this->addSql('DROP TABLE eventos');
        $this->addSql('DROP TABLE eventos_deportes');
        $this->addSql('DROP TABLE seccion_evento');
        $this->addSql('DROP TABLE secciones');
        $this->addSql('DROP TABLE transaxxiones');
    }
}
