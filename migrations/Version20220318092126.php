<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220318092126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание таблицы юзеров';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
        CREATE TABLE users (
            id int primary key, 
            login varchar(255) unique,
            password varchar(255)
            )
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE users");
    }
}
