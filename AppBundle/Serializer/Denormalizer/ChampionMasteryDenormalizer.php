<?php
namespace Psi\AppBundle\Serializer\Denormalizer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\ChampionMasteryConverter;
use Psi\AppBundle\Entity\ChampionMastery;
use Psi\AppBundle\Entity\Summoner;
use Psi\ApiBundle\Response\ChampionMasteryResponse;

class ChampionMasteryDenormalizer extends AbstractResponseDenormalizer
{

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $data = $response->getData();

        $normalizer = new ObjectNormalizer(null, new ChampionMasteryConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);

        $summonerId = $data['playerId'];
        $championId = $data['championId'];

        $summoner = $this->manager->getRepository(Summoner::class)->findOneBy(['externalId' => $summonerId]);

        if (!$summoner) {
            return null;
        }

        $championMastery = $this->manager->getRepository(ChampionMastery::class)->findOneBy([
            'summoner' => $summoner,
            'externalId' => $championId
        ]);
        if (!$championMastery) {
            $championMastery = new ChampionMastery();
        }

        $serializer->denormalize($data, ChampionMastery::class, 'json', ['object_to_populate' => $championMastery]);
        $timestamp = $championMastery->getLastPlayTime() / 1000;
        $lastPlayTime = new \DateTime();
        $lastPlayTime->setTimestamp($timestamp);
        $championMastery->setLastPlayTime($lastPlayTime);
        $championMastery->setSummoner($summoner);

        return $championMastery;
    }

    public function getResponseClass()
    {
        return ChampionMasteryResponse::class;
    }
}
