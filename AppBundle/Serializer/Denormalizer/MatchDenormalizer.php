<?php
namespace Psi\AppBundle\Serializer\Denormalizer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\MatchConverter;
use Psi\AppBundle\Entity\Match;
use Psi\ApiBundle\Response\MatchResponse;

class MatchDenormalizer extends AbstractResponseDenormalizer
{

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $data = $response->getData();

        $normalizer = new ObjectNormalizer(null, new MatchConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);

        $match = new Match();
        $match->setArchived(0);

        $serializer->denormalize($data, Match::class, 'json', ['object_to_populate' => $match]);
        
        // update creation date (api returned microtime)
        $timestamp = $match->getCreatedAt() / 1000;
        $gameCreation = new \DateTime();
        $gameCreation->setTimestamp($timestamp);
        $match->setCreatedAt($gameCreation);
        
        // update participants
        foreach($data['participantIdentities'] as $participantData) {
            foreach($match->getParticipants() as $participant) {
                
            }
        }

        return $match;
    }

    public function getResponseClass()
    {
        return MatchResponse::class;
    }
}
