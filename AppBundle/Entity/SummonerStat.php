<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * SummonerStat
 *
 * @ORM\Entity()
 * @ORM\Table(name="summoner_stat",indexes={@ORM\Index(name="search_idx", columns={"name","summoner_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class SummonerStat
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
     * @var Summoner 
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Summoner")
     */
    protected $summoner;

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
     * @return SummonerStat
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
     * @return SummonerStat
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
     * @return SummonerStat
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
     * Set summoner
     *
     * @param \Psi\AppBundle\Entity\Summoner $summoner
     *
     * @return SummonerStat
     */
    public function setSummoner(\Psi\AppBundle\Entity\Summoner $summoner = null)
    {
        $this->summoner = $summoner;

        return $this;
    }

    /**
     * Get summoner
     *
     * @return \Psi\AppBundle\Entity\Summoner
     */
    public function getSummoner()
    {
        return $this->summoner;
    }
}
