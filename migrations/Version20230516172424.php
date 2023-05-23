<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516172424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Add collumn user_password in table user";
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<< SQL
            ALTER TABLE user ADD user_password VARCHAR(200) NOT NULL;
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<< SQL
            ALTER TABLE user DROP user_password;
        SQL
        );
    }
}
