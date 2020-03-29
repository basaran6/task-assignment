<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329081604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE developer_task (id INT AUTO_INCREMENT NOT NULL, developer_id_id INT NOT NULL, task_id_id INT NOT NULL, INDEX IDX_FAEA66690CC5E00 (developer_id_id), UNIQUE INDEX UNIQ_FAEA666B8E08577 (task_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA66690CC5E00 FOREIGN KEY (developer_id_id) REFERENCES developer (id)');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA666B8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE developer_task');
    }
}
