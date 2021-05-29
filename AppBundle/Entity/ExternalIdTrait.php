<?php
// Stefan Erakovic 3086/2016

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ExternalIdTrait
{

    /**
     *
     * @var string
     * @ORM\Column(name="external_id", type="bigint", nullable=true) 
     */
    protected $externalId;

    /**
     * Set externalId
     *
     * @param integer $externalId
     *
     * @return Mastery
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Get externalId
     *
     * @return integer
     */
    public function getExternalId()
    {
        return $this->externalId;
    }
}
