<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181004113034 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE access_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE FOSUser_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE auth_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE access_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6A2DD685F37A13B ON access_token (token)');
        $this->addSql('CREATE INDEX IDX_B6A2DD6819EB6921 ON access_token (client_id)');
        $this->addSql('CREATE INDEX IDX_B6A2DD68A76ED395 ON access_token (user_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris TEXT NOT NULL, secret VARCHAR(255) NOT NULL, allowed_grant_types TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.redirect_uris IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN client.allowed_grant_types IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE FOSUser (id INT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_37EF34F492FC23A8 ON FOSUser (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_37EF34F4A0D96FBF ON FOSUser (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_37EF34F4C05FB297 ON FOSUser (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN FOSUser.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F21955F37A13B ON refresh_token (token)');
        $this->addSql('CREATE INDEX IDX_C74F219519EB6921 ON refresh_token (client_id)');
        $this->addSql('CREATE INDEX IDX_C74F2195A76ED395 ON refresh_token (user_id)');
        $this->addSql('CREATE TABLE auth_code (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri TEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5933D02C5F37A13B ON auth_code (token)');
        $this->addSql('CREATE INDEX IDX_5933D02C19EB6921 ON auth_code (client_id)');
        $this->addSql('CREATE INDEX IDX_5933D02CA76ED395 ON auth_code (user_id)');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD6819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD68A76ED395 FOREIGN KEY (user_id) REFERENCES FOSUser (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F219519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F2195A76ED395 FOREIGN KEY (user_id) REFERENCES FOSUser (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_code ADD CONSTRAINT FK_5933D02C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_code ADD CONSTRAINT FK_5933D02CA76ED395 FOREIGN KEY (user_id) REFERENCES FOSUser (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD6819EB6921');
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT FK_C74F219519EB6921');
        $this->addSql('ALTER TABLE auth_code DROP CONSTRAINT FK_5933D02C19EB6921');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD68A76ED395');
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT FK_C74F2195A76ED395');
        $this->addSql('ALTER TABLE auth_code DROP CONSTRAINT FK_5933D02CA76ED395');
        $this->addSql('DROP SEQUENCE access_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE FOSUser_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE auth_code_id_seq CASCADE');
        $this->addSql('DROP TABLE access_token');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE FOSUser');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE auth_code');
    }
}
