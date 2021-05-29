<?php
namespace Psi\AppBundle\Serializer\Denormalizer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\SummonerConverter;
use Psi\AppBundle\Entity\Summoner;
use Psi\ApiBundle\Response\SummonerResponse;

class SummonerDenormalizer extends AbstractResponseDenormalizer
{

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $data = $response->getData();
        $normalizer = new ObjectNormalizer(null, new SummonerConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);
        $externalId = $data['id'];

        $summoner = $this->manager->getRepository(Summoner::class)->findOneBy(['externalId' => $externalId]);
        if (!$summoner) {
            $summoner = new Summoner();
        }

        $serializer->denormalize($data, Summoner::class, 'json', ['object_to_populate' => $summoner]);
        $summoner->setExternalId($data['id']);

        return $summoner;
    }

    public function getResponseClass()
    {
        return SummonerResponse::class;
    }
}
