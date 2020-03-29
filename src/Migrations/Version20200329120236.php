<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329120236 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA66690CC5E00');
        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA666B8E08577');
        $this->addSql('DROP INDEX UNIQ_FAEA666B8E08577 ON developer_task');
        $this->addSql('DROP INDEX IDX_FAEA66690CC5E00 ON developer_task');
        $this->addSql('ALTER TABLE developer_task ADD developer_id INT NOT NULL, ADD task_id INT NOT NULL, DROP developer_id_id, DROP task_id_id');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA66664DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id)');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA6668DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_FAEA66664DD9267 ON developer_task (developer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FAEA6668DB60186 ON developer_task (task_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA66664DD9267');
        $this->addSql('ALTER TABLE developer_task DROP FOREIGN KEY FK_FAEA6668DB60186');
        $this->addSql('DROP INDEX IDX_FAEA66664DD9267 ON developer_task');
        $this->addSql('DROP INDEX UNIQ_FAEA6668DB60186 ON developer_task');
        $this->addSql('ALTER TABLE developer_task ADD developer_id_id INT NOT NULL, ADD task_id_id INT NOT NULL, DROP developer_id, DROP task_id');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA66690CC5E00 FOREIGN KEY (developer_id_id) REFERENCES developer (id)');
        $this->addSql('ALTER TABLE developer_task ADD CONSTRAINT FK_FAEA666B8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FAEA666B8E08577 ON developer_task (task_id_id)');
        $this->addSql('CREATE INDEX IDX_FAEA66690CC5E00 ON developer_task (developer_id_id)');
    }
}
