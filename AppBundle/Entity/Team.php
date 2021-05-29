<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;

/**
 * Team
 *
 * @ORM\Entity()
 * @ORM\Table(name="match_team")
 * @ORM\HasLifecycleCallbacks
 */
class Team
{

    use ImportedAtTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Match 
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Match", inversedBy="teams")
     */
    protected $match;

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
     * Set match
     *
     * @param \Psi\AppBundle\Entity\Match $match
     *
     * @return Team
     */
    public function setMatch(\Psi\AppBundle\Entity\Match $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \Psi\AppBundle\Entity\Match
     */
    public function getMatch()
    {
        return $this->match;
    }
}
