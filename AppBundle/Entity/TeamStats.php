<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * TeamStats
 *
 * @ORM\Entity()
 * @ORM\Table(name="match_team_stat",indexes={@ORM\Index(name="search_idx", columns={"name","team_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class TeamStats
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
     * @var string
     * @ORM\Column(name="type", type="string", length=32)
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=64)
     */
    protected $statname;

    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=64)
     */
    protected $value;

    /**
     * @var Team 
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Team")
     */
    protected $team;

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
     * Set type
     *
     * @param string $type
     *
     * @return TeamStats
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set statname
     *
     * @param string $statname
     *
     * @return TeamStats
     */
    public function setStatname($statname)
    {
        $this->statname = $statname;

        return $this;
    }

    /**
     * Get statname
     *
     * @return string
     */
    public function getStatname()
    {
        return $this->statname;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return TeamStats
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set team
     *
     * @param \Psi\AppBundle\Entity\Team $team
     *
     * @return TeamStats
     */
    public function setTeam(\Psi\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Psi\AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
