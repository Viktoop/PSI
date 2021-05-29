<?php
// Viktor Galindo - 655/2013

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ExternalIdTrait;
use Psi\AppBundle\Entity\MasteryPage;

/**
 * Mastery
 *
 * @ORM\Entity()
 * @ORM\Table(name="summoner_mastery")
 */
class Mastery
{

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
     * @var MasteryPage
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\MasteryPage", inversedBy="masteries")
     */
    protected $masteryPage;

    /**
     * @var integer
     * @ORM\Column(name="rank", type="integer")
     */
    protected $rank;

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
     * Set rank
     *
     * @param integer $rank
     *
     * @return Mastery
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set masteryPage
     *
     * @param \Psi\AppBundle\Entity\MasteryPage $masteryPage
     *
     * @return Mastery
     */
    public function setMasterypage(\Psi\AppBundle\Entity\MasteryPage $masteryPage = null)
    {
        $this->masteryPage = $masteryPage;

        return $this;
    }

    /**
     * Get masteryPage
     *
     * @return \Psi\AppBundle\Entity\MasteryPage
     */
    public function getMasterypage()
    {
        return $this->masteryPage;
    }
}
