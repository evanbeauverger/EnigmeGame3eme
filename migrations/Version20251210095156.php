<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210095156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enigma (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, game_id INT DEFAULT NULL, order_ INT DEFAULT NULL, title VARCHAR(50) NOT NULL, instruction LONGTEXT NOT NULL, secretcode VARCHAR(100) NOT NULL, INDEX IDX_2EA9D76EC54C8C93 (type_id), INDEX IDX_2EA9D76EE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enigma_thumbnail (enigma_id INT NOT NULL, thumbnail_id INT NOT NULL, INDEX IDX_1B0321AE457B6BA0 (enigma_id), INDEX IDX_1B0321AEFDFF2E92 (thumbnail_id), PRIMARY KEY(enigma_id, thumbnail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enigma_user (enigma_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9099819D457B6BA0 (enigma_id), INDEX IDX_9099819DA76ED395 (user_id), PRIMARY KEY(enigma_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, setting_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, welcome_msg LONGTEXT NOT NULL, welcome_img VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_232B318CEE35BD72 (setting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_user (game_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6686BA65E48FD905 (game_id), INDEX IDX_6686BA65A76ED395 (user_id), PRIMARY KEY(game_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, game INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, avatar_id INT NOT NULL, game_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, position INT DEFAULT NULL, current_enigma INT NOT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_C4E0A61F86383B10 (avatar_id), INDEX IDX_C4E0A61FE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thumbnail (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, information LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(50) NOT NULL, is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enigma ADD CONSTRAINT FK_2EA9D76EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE enigma ADD CONSTRAINT FK_2EA9D76EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE enigma_thumbnail ADD CONSTRAINT FK_1B0321AE457B6BA0 FOREIGN KEY (enigma_id) REFERENCES enigma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enigma_thumbnail ADD CONSTRAINT FK_1B0321AEFDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES thumbnail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enigma_user ADD CONSTRAINT FK_9099819D457B6BA0 FOREIGN KEY (enigma_id) REFERENCES enigma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enigma_user ADD CONSTRAINT FK_9099819DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEE35BD72 FOREIGN KEY (setting_id) REFERENCES setting (id)');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F86383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enigma DROP FOREIGN KEY FK_2EA9D76EC54C8C93');
        $this->addSql('ALTER TABLE enigma DROP FOREIGN KEY FK_2EA9D76EE48FD905');
        $this->addSql('ALTER TABLE enigma_thumbnail DROP FOREIGN KEY FK_1B0321AE457B6BA0');
        $this->addSql('ALTER TABLE enigma_thumbnail DROP FOREIGN KEY FK_1B0321AEFDFF2E92');
        $this->addSql('ALTER TABLE enigma_user DROP FOREIGN KEY FK_9099819D457B6BA0');
        $this->addSql('ALTER TABLE enigma_user DROP FOREIGN KEY FK_9099819DA76ED395');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEE35BD72');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA65E48FD905');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA65A76ED395');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F86383B10');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FE48FD905');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE enigma');
        $this->addSql('DROP TABLE enigma_thumbnail');
        $this->addSql('DROP TABLE enigma_user');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_user');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE thumbnail');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
