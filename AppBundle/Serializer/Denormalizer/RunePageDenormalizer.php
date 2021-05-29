<?php
namespace Psi\AppBundle\Serializer\Denormalizer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\RunePageConverter;
use Psi\AppBundle\Entity\RunePage;
use Psi\ApiBundle\Response\RuneResponse;

class RunePageDenormalizer extends AbstractResponseDenormalizer
{

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $data = $response->getData();

        $runePages = [];
        $normalizer = new ObjectNormalizer(null, new RunePageConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);

        foreach ($data['pages'] as $runePageData) {
            $externalId = $runePageData['id'];

            $runePage = $this->manager->getRepository(RunePage::class)->findOneBy(['externalId' => $externalId]);
            if (!$runePage) {
                $runePage = new RunePage();
            }

            $serializer->denormalize($runePageData, RunePage::class, 'json', ['object_to_populate' => $runePage]);

            $runePages[] = $runePage;
        }
        return $runePages;
    }

    public function getResponseClass()
    {
        return RuneResponse::class;
    }
}
