<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107164001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_film (user_id INT NOT NULL, film_id INT NOT NULL, PRIMARY KEY(user_id, film_id))');
        $this->addSql('CREATE INDEX IDX_F8C5F2EBA76ED395 ON user_film (user_id)');
        $this->addSql('CREATE INDEX IDX_F8C5F2EB567F5183 ON user_film (film_id)');
        $this->addSql('ALTER TABLE user_film ADD CONSTRAINT FK_F8C5F2EBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_film ADD CONSTRAINT FK_F8C5F2EB567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD name VARCHAR(255) NOT NULL');
        $this->addSql("
insert into public.film (id, price, subscription_access, name)
values  (1, 0, 0, 'Остров фантазий'),
        (2, 0, 2, 'Отель Белград'),
        (3, 0, 2, 'Паразиты'),
        (4, 300, 0, 'Зов предков'),
        (5, 0, 1, 'Игра Престолов'),
        (6, 0, 1, 'Миллиарды'),
        (7, 0, 1, 'Проповедник'),
        (8, 0, 0, 'История игрушек 4'),
        (9, 0, 2, 'Как приручить дракона 3'),
        (10, 0, 0, 'Моана'),
        (11, 200, 0, 'Оно'),
        (12, 0, 0, 'Поезд в пусан'),
        (13, 0, 0, 'Мэг: монстр глубины');
");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_film DROP CONSTRAINT FK_F8C5F2EBA76ED395');
        $this->addSql('ALTER TABLE user_film DROP CONSTRAINT FK_F8C5F2EB567F5183');
        $this->addSql('DROP TABLE user_film');
        $this->addSql('ALTER TABLE film DROP name');
    }
}
