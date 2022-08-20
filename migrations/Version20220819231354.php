<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220819231354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_history ADD account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE account_history ADD CONSTRAINT FK_EE9164039B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_EE9164039B6B5FBA ON account_history (account_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_history DROP FOREIGN KEY FK_EE9164039B6B5FBA');
        $this->addSql('DROP INDEX IDX_EE9164039B6B5FBA ON account_history');
        $this->addSql('ALTER TABLE account_history DROP account_id');
    }
}
