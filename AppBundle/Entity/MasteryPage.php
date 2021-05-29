<?php
// Viktor Galindo - 655/2013
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * MasteryPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="summoner_masterypage")
 * @ORM\HasLifecycleCallbacks
 */
class MasteryPage
{

    use ImportedAtTrait;
    use ExternalIdTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @var Mastery[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Psi\AppBundle\Entity\Mastery", mappedBy="masteryPage",cascade={"all"})
     * @ORM\OrderBy({"externalId" = "DESC"})
     */
    protected $masteries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->masteries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return MasteryPage
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
     * Add mastery
     *
     * @param \Psi\AppBundle\Entity\Mastery $mastery
     *
     * @return MasteryPage
     */
    public function addMastery(\Psi\AppBundle\Entity\Mastery $mastery)
    {
        $this->masteries[] = $mastery;
        $mastery->setMasterypage($this);
        return $this;
    }

    /**
     * Remove mastery
     *
     * @param \Psi\AppBundle\Entity\Mastery $mastery
     */
    public function removeMastery(\Psi\AppBundle\Entity\Mastery $mastery)
    {
        $mastery->setMasterypage(null);
        $this->masteries->removeElement($mastery);
    }

    /**
     * Get masteries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMasteries()
    {
        return $this->masteries;
    }
}
