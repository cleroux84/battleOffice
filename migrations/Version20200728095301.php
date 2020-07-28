<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728095301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shipping_clients ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping_clients ADD CONSTRAINT FK_E68028B019EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E68028B019EB6921 ON shipping_clients (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shipping_clients DROP FOREIGN KEY FK_E68028B019EB6921');
        $this->addSql('DROP INDEX UNIQ_E68028B019EB6921 ON shipping_clients');
        $this->addSql('ALTER TABLE shipping_clients DROP client_id');
    }
}
