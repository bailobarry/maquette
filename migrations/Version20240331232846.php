<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240331232846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blocs_competences (id INT AUTO_INCREMENT NOT NULL, diplomes_id INT DEFAULT NULL, id_comp VARCHAR(8) NOT NULL, nom_bloc_comp VARCHAR(100) NOT NULL, description_bloc_comp VARCHAR(255) NOT NULL, INDEX IDX_EF2957A2A953C628 (diplomes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blocs_connaissances (id INT AUTO_INCREMENT NOT NULL, diplomes_id INT DEFAULT NULL, id_conn VARCHAR(8) NOT NULL, nom_bloc_conn VARCHAR(10) NOT NULL, description_bloc_conn VARCHAR(255) NOT NULL, INDEX IDX_E9173582A953C628 (diplomes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, ues_id INT DEFAULT NULL, bloc_competences_id INT DEFAULT NULL, ects_comp SMALLINT NOT NULL, description_comp VARCHAR(255) NOT NULL, INDEX IDX_DB2077CE5B75D6BC (ues_id), INDEX IDX_DB2077CE36265666 (bloc_competences_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE connaissances (id INT AUTO_INCREMENT NOT NULL, ues_id INT DEFAULT NULL, bloc_connaissances_id INT DEFAULT NULL, ects_conn SMALLINT NOT NULL, description_conn VARCHAR(255) NOT NULL, INDEX IDX_1B3105E85B75D6BC (ues_id), INDEX IDX_1B3105E892B24CAC (bloc_connaissances_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplomes (id INT AUTO_INCREMENT NOT NULL, nom_dip VARCHAR(100) NOT NULL, etablissement_dip VARCHAR(100) NOT NULL, annees_dip VARCHAR(10) NOT NULL, nb_semestres_dip SMALLINT NOT NULL, lmd VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mccrne (id INT AUTO_INCREMENT NOT NULL, intitule_mcc VARCHAR(20) NOT NULL, description_mcc VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, diplomes_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, id_parc VARCHAR(8) NOT NULL, nom_parc VARCHAR(100) NOT NULL, annees_parc SMALLINT NOT NULL, INDEX IDX_99B1DEE3A953C628 (diplomes_id), INDEX IDX_99B1DEE3F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ues (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, mcc_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, reference VARCHAR(10) NOT NULL, semestre SMALLINT NOT NULL, titre VARCHAR(100) NOT NULL, ects SMALLINT NOT NULL, type VARCHAR(15) NOT NULL, prerequis VARCHAR(255) NOT NULL, cm INT NOT NULL, td INT NOT NULL, tp INT NOT NULL, effectif INT NOT NULL, groupe_cm SMALLINT NOT NULL, groupe_td SMALLINT NOT NULL, groupe_tp SMALLINT NOT NULL, INDEX IDX_7CFDCCCD1E969C5 (utilisateurs_id), INDEX IDX_7CFDCCCD6BA9F475 (mcc_id), INDEX IDX_7CFDCCCDF6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, diplomes_id INT DEFAULT NULL, role_id INT DEFAULT NULL, nom_user VARCHAR(15) NOT NULL, prenom_user VARCHAR(30) NOT NULL, mail VARCHAR(30) NOT NULL, password VARCHAR(15) NOT NULL, INDEX IDX_497B315EA953C628 (diplomes_id), INDEX IDX_497B315ED60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blocs_competences ADD CONSTRAINT FK_EF2957A2A953C628 FOREIGN KEY (diplomes_id) REFERENCES diplomes (id)');
        $this->addSql('ALTER TABLE blocs_connaissances ADD CONSTRAINT FK_E9173582A953C628 FOREIGN KEY (diplomes_id) REFERENCES diplomes (id)');
        $this->addSql('ALTER TABLE competences ADD CONSTRAINT FK_DB2077CE5B75D6BC FOREIGN KEY (ues_id) REFERENCES ues (id)');
        $this->addSql('ALTER TABLE competences ADD CONSTRAINT FK_DB2077CE36265666 FOREIGN KEY (bloc_competences_id) REFERENCES blocs_competences (id)');
        $this->addSql('ALTER TABLE connaissances ADD CONSTRAINT FK_1B3105E85B75D6BC FOREIGN KEY (ues_id) REFERENCES ues (id)');
        $this->addSql('ALTER TABLE connaissances ADD CONSTRAINT FK_1B3105E892B24CAC FOREIGN KEY (bloc_connaissances_id) REFERENCES blocs_connaissances (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3A953C628 FOREIGN KEY (diplomes_id) REFERENCES diplomes (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE ues ADD CONSTRAINT FK_7CFDCCCD1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE ues ADD CONSTRAINT FK_7CFDCCCD6BA9F475 FOREIGN KEY (mcc_id) REFERENCES mccrne (id)');
        $this->addSql('ALTER TABLE ues ADD CONSTRAINT FK_7CFDCCCDF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315EA953C628 FOREIGN KEY (diplomes_id) REFERENCES diplomes (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315ED60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs_competences DROP FOREIGN KEY FK_EF2957A2A953C628');
        $this->addSql('ALTER TABLE blocs_connaissances DROP FOREIGN KEY FK_E9173582A953C628');
        $this->addSql('ALTER TABLE competences DROP FOREIGN KEY FK_DB2077CE5B75D6BC');
        $this->addSql('ALTER TABLE competences DROP FOREIGN KEY FK_DB2077CE36265666');
        $this->addSql('ALTER TABLE connaissances DROP FOREIGN KEY FK_1B3105E85B75D6BC');
        $this->addSql('ALTER TABLE connaissances DROP FOREIGN KEY FK_1B3105E892B24CAC');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3A953C628');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3F6203804');
        $this->addSql('ALTER TABLE ues DROP FOREIGN KEY FK_7CFDCCCD1E969C5');
        $this->addSql('ALTER TABLE ues DROP FOREIGN KEY FK_7CFDCCCD6BA9F475');
        $this->addSql('ALTER TABLE ues DROP FOREIGN KEY FK_7CFDCCCDF6203804');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315EA953C628');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315ED60322AC');
        $this->addSql('DROP TABLE blocs_competences');
        $this->addSql('DROP TABLE blocs_connaissances');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE connaissances');
        $this->addSql('DROP TABLE diplomes');
        $this->addSql('DROP TABLE mccrne');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE ues');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
