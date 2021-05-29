<?php
// Nemanja Djokic - 496/2013

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * RunePage
 *
 * @ORM\Entity()
 * @ORM\Table(name="summoner_runepage")
 * @ORM\HasLifecycleCallbacks
 */
class RunePage
{

    use ImportedAtTrait;
    use ExternalIdTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var string 
     * @ORM\Column(name="name", type="string", nullable=true) 
     */
    protected $name;

    /**
     * @var \Psi\AppBundle\Entity\Rune[]
     * @ORM\OneToMany(targetEntity="Psi\AppBundle\Entity\Rune", mappedBy="runePage",cascade={"all"})
     * @ORM\OrderBy({"slotId" = "ASC"})
     */
    protected $runes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->runes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RunePage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add rune
     *
     * @param \Psi\AppBundle\Entity\Rune $rune
     *
     * @return RunePage
     */
    public function addRune(\Psi\AppBundle\Entity\Rune $rune)
    {
        $this->runes[] = $rune;
        $rune->setRunePage($this);
        return $this;
    }

    /**
     * Remove rune
     *
     * @param \Psi\AppBundle\Entity\Rune $rune
     */
    public function removeRune(\Psi\AppBundle\Entity\Rune $rune)
    {
        $this->runes->removeElement($rune);
    }

    /**
     * Get runes
     *
     * @return \Psi\AppBundle\Entity\Rune[]
     */
    public function getRunes()
    {
        return $this->runes;
    }

    /**
     * 
     * @param \Psi\AppBundle\Entity\Rune[] $runes
     */
    public function setRunes($runes)
    {
        $this->runes = $runes;
    }
}
