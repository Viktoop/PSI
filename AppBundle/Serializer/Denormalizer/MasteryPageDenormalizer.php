<?php
namespace Psi\AppBundle\Serializer\Denormalizer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\MasteryPageConverter;
use Psi\AppBundle\Entity\MasteryPage;
use Psi\ApiBundle\Response\MasteryResponse;

class MasteryPageDenormalizer extends AbstractResponseDenormalizer
{

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $data = $response->getData();
        
        $masteryPages = [];
        $normalizer = new ObjectNormalizer(null, new MasteryPageConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);

        foreach ($data['pages'] as $masteryPageData) {
            $externalId = $masteryPageData['id'];

            $masteryPage = $this->manager->getRepository(MasteryPage::class)->findOneBy(['externalId' => $externalId]);
            if (!$masteryPage) {
                $masteryPage = new MasteryPage();
            }

            $serializer->denormalize($masteryPageData, MasteryPage::class, 'json', ['object_to_populate' => $masteryPage]);

            $masteryPages[] = $masteryPage;
        }

        return $masteryPages;
    }

    public function getResponseClass()
    {
        return MasteryResponse::class;
    }
}
