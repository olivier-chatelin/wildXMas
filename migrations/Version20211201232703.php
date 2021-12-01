<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201232703 extends AbstractMigration
{
    public const TRANSLATION_TABLE = [
        "Receive a name tag" => 'RECEVOIR UN BADGE',
        'WEAR A CHRISTMAS ITEM ALL DAY LONG' => 'PORTER UN OBJET DE NOEL TOUTE LA JOURNEE',
        'EARN A CODEWARS CHOSEN BY YOUR TRAINER' => 'Réussir un codewars choisi par ton formateur',
        'MAKE A QUEST FROM ANOTHER TRAINING' => 'Faire une quête d\'un autre cursus',
        'Exchange its watch' => 'Echanger sa veille',
        'Animate a dojo' => 'Anime un dojo',
        'RECEIVE A WILD ITEM' => 'RECEVOIR UN OBJET WILD',
        'To do its daily in english' => 'Faire son daily en Anglais',
        'BECOME THE WEEK DELEGUATE' => 'Devenir délégué de la semaine',
        'TO CODE WITH ANOTHER IDE ALL DAY LONG' => 'Coder avec un autre IDE toute la journée',
        'MODIFY YOUR PSEUDO INTO \"SANTA CLAUS\"AND MEET ALL THE REQUESTS OF YOUR CLASS' => 'Modifier ton pseudo en père noël et répondre à toutes les demandes de ta promo',
        'ANIMATE  A LIVE CODING' => 'Animer un live coding',
        'Short day of 30 min' => 'short day de 30 min',
        'DRESS UP AS YOUR TRAINER ON WEDNESDAY 22' => 'Se déguiser en ton formateur',
        'TO HAVE ANOTHER WATCH' => 'Faire une veille en plus',
        'CHOOSE THE GAME' => 'Choisir le jeu',
        'YOUR TRAINER MAKES YOUR COFFEE ALL DAY LONG' => 'Ton formateur te fait ton café toute la journée',
        'Sleep in the morning' => 'Bon pour une grasse matinée en accord avec ton formateur et ton SEM',
        'COOK A CAKE OR BRING CANDIES FOR THE CLASS' => 'Faire un gateau ou amener des bonbons'
    ];
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        foreach (self::TRANSLATION_TABLE as $english => $french) {

        $this->addSql(
                'UPDATE reward r
                    JOIN instructor_reward ir
                    ON r.id = ir.reward_id
                    JOIN instructor i
                    ON i.id = ir.instructor_id
                    SET  r.title = "' . $french .
                    '" WHERE r.title = "' . $english .
                    '" AND i.is_french = 1'
                    );
        }
    }


}
