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
            VALUES (1, 'test@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$WkTUyfaTxERLvIkC0+7erA$+VmhqjOwfB7f5f3EDk/RMYX5FeinYL3xEnw/gmX5Qhw', 'test');"
        );

        /*
        {
          "email": "test@gmail.com",
          "password": "test"
        } */
    }

    public function down(Schema $schema) : void
    {
        $this->connection->executeQuery(
            "DELETE * FROM user"
        );
    }
}
