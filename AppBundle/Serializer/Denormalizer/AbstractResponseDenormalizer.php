<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AppBundle\Serializer\Denormalizer;

use Psi\AppBundle\Serializer\Denormalizer\ApiResponseDenormalizerInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class AbstractResponseDenormalizer implements ApiResponseDenormalizerInterface
{

    /**
     *
     * @var ObjectManager 
     */
    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function supportsResponse(\Psi\ApiBundle\Response\AbstractResponse $response): bool
    {
        return (get_class($response) == $this->getResponseClass());
    }

    abstract public function getResponseClass();
}
