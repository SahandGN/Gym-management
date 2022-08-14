<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220814162115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locker DROP INDEX FK_1E067DC07E3C61F9, ADD UNIQUE INDEX UNIQ_1E067DC07E3C61F9 (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locker DROP INDEX UNIQ_1E067DC07E3C61F9, ADD INDEX FK_1E067DC07E3C61F9 (owner_id)');
    }
}
