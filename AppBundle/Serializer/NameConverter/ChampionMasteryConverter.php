<?php
// Nemanja Djokic - 496/2013
namespace Psi\AppBundle\Serializer\NameConverter;

class ChampionMasteryConverter extends AbstractNameConverter
{

    public function getTranslations()
    {
        return [
            'playerId' => 'summonerId',
            'championId' => 'externalId'
        ];
    }
}
