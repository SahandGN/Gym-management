<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826075520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD number_of_classes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491FB354CD FOREIGN KEY (membership_id) REFERENCES membership (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491FB354CD ON user (membership_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491FB354CD');
        $this->addSql('DROP INDEX IDX_8D93D6491FB354CD ON user');
        $this->addSql('ALTER TABLE user DROP number_of_classes');
    }
}
