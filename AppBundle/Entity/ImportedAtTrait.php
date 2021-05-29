<?php
// Stefan Erakovic 3086/2016

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ImportedAtTrait
{

    /**
     * @var \DateTime
     * @ORM\Column(name="imported_at", type="datetime")
     */
    protected $importedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getImportedAt() == null) {
            $this->setImportedAt(new \DateTime('now'));
        }
    }

    /**
     * Set importedAt
     *
     * @param \DateTime $importedAt
     *
     * @return Participant
     */
    public function setImportedAt($importedAt)
    {
        $this->importedAt = $importedAt;

        return $this;
    }

    /**
     * Get importedAt
     *
     * @return \DateTime
     */
    public function getImportedAt()
    {
        return $this->importedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Participant
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
