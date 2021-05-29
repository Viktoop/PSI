<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AppBundle\Serializer\Denormalizer;

use Psi\ApiBundle\Response\AbstractResponse;

interface ApiResponseDenormalizerInterface
{

    /**
     * Returns a denormalized entity
     * @param AbstractResponse $response
     * @return mixed
     */
    public function denormalizeResponse(AbstractResponse $response);

    /**
     * Returns whether the response is supported for denormalization
     * @param AbstractResponse $response
     * @return bool
     */
    public function supportsResponse(AbstractResponse $response);
}
