<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200402161157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->executeQuery(
            "INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`)
             VALUES (1, 'tester@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ZAPsjLBWW+RTQ+dLWP8+qw$F26TqwR2J9sCxm8K0xJm605oFfKr4ugPEfK4bxeAwaA', 'tester');"
         );
    }

    public function down(Schema $schema) : void
    {
        $this->connection->executeQuery(
            "DELETE * FROM user"
        );
    }
}
