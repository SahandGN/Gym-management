<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816173909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491FB354CD');
        $this->addSql('DROP INDEX fk_8d93d6491fb354cd ON user');
        $this->addSql('CREATE INDEX IDX_8D93D6491FB354CD ON user (membership_id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491FB354CD');
        $this->addSql('DROP INDEX idx_8d93d6491fb354cd ON user');
        $this->addSql('CREATE INDEX FK_8D93D6491FB354CD ON user (membership_id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id)');
    }
}
