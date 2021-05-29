<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AppBundle\Serializer\NameConverter;

class MatchConverter extends AbstractNameConverter
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
            'runes' => 'runePage',
            'masteries' => 'masteryPage'
        ];
    }
}
