<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606105300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Ad role in user table";
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<< SQL
            ALTER TABLE user ADD user_role INT(1) NOT NULL;
        SQL
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<< SQL
            ALTER TABLE user DROP user_role;
        SQL
        );
    }
}
