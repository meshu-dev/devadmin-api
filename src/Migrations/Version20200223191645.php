<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200223191645 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $envNames = ['Dev', 'Test', 'Live'];

        foreach ($envNames as $envName) {
            $this->connection->executeQuery("INSERT environment(name) VALUES ('$envName')");
        }
    }

    public function down(Schema $schema) : void
    {
        $this->connection->executeQuery('DELETE * FROM environment');
    }
}
