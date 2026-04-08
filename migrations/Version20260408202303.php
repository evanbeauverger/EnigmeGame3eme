<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408202303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enigma ADD option_a VARCHAR(255) DEFAULT NULL, ADD option_b VARCHAR(255) DEFAULT NULL, ADD option_c VARCHAR(255) DEFAULT NULL, ADD option_d VARCHAR(255) DEFAULT NULL, CHANGE game_id game_id INT DEFAULT NULL, CHANGE order_ order_ INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enigma DROP option_a, DROP option_b, DROP option_c, DROP option_d, CHANGE game_id game_id INT NOT NULL, CHANGE order_ order_ INT NOT NULL');
    }
}
