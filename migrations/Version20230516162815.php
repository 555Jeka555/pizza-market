<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516162815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Delete old rows in user table";
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<< SQL
            DELETE FROM user
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        
    }
}
