<?php
// Viktor Galindo - 655/2013
namespace Psi\AppBundle\Serializer\NameConverter;

class ActiveMatchConverter extends AbstractNameConverter
{

    public function getTranslations()
    {
        return [
            'gameId' => 'externalId',
            'platformId' => 'region',
            'gameDuration' => 'duration',
            'seasonId' => 'season',
            'gameType' => 'queueType',
            'gameMode' => 'matchType',
            'mapId' => 'mapId',
            'gameVersion' => 'version',
            'gameCreation' => 'createdAt',
            'spell1Id' => 'spellId1',
            'spell2Id' => 'spellId2',
        ];
    }
}
