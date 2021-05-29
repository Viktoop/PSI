<?php
// Stefan Erakovic 3086/2016

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * ChampionMastery
 *
 * @ORM\Entity()
 * @ORM\Table(name="champion_mastery")
 * @ORM\HasLifecycleCallbacks
 */
class ChampionMastery
{

    use ExternalIdTrait;
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
     * @var Summoner
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Summoner")
     */
    protected $summoner;

    /**
     * ?
     */
    protected $championId;

    /**
     * @var boolean
     * @ORM\Column(name="chest_granted", type="boolean")
     */
    protected $chestGranted;

    /**
     * @var integer
     * @ORM\Column(name="champion_points", type="integer")
     */
    protected $championPoints;

    /**
     * @var integer
     * @ORM\Column(name="champion_level", type="integer")
     */
    protected $championLevel;

    /**
     * @var integer
     * @ORM\Column(name="champion_points_next_level", type="integer")
     */
    protected $championPointsUntilNextLevel;

    /**
     * @var integer
     * @ORM\Column(name="champion_points_last_level", type="integer")
     */
    protected $championPointsSinceLastLevel;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_play_time", type="datetime")
     */
    protected $lastPlayTime;

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
     * Set chestGranted
     *
     * @param boolean $chestGranted
     *
     * @return ChampionMastery
     */
    public function setChestGranted($chestGranted)
    {
        $this->chestGranted = $chestGranted;

        return $this;
    }

    /**
     * Get chestGranted
     *
     * @return boolean
     */
    public function getChestGranted()
    {
        return $this->chestGranted;
    }

    /**
     * Set championPoints
     *
     * @param integer $championPoints
     *
     * @return ChampionMastery
     */
    public function setChampionPoints($championPoints)
    {
        $this->championPoints = $championPoints;

        return $this;
    }

    /**
     * Get championPoints
     *
     * @return integer
     */
    public function getChampionPoints()
    {
        return $this->championPoints;
    }

    /**
     * Set championLevel
     *
     * @param integer $championLevel
     *
     * @return ChampionMastery
     */
    public function setChampionLevel($championLevel)
    {
        $this->championLevel = $championLevel;

        return $this;
    }

    /**
     * Get championLevel
     *
     * @return integer
     */
    public function getChampionLevel()
    {
        return $this->championLevel;
    }

    /**
     * Set championPointsUntilNextLevel
     *
     * @param integer $championPointsUntilNextLevel
     *
     * @return ChampionMastery
     */
    public function setChampionPointsUntilNextLevel($championPointsUntilNextLevel)
    {
        $this->championPointsUntilNextLevel = $championPointsUntilNextLevel;

        return $this;
    }

    /**
     * Get championPointsUntilNextLevel
     *
     * @return integer
     */
    public function getChampionPointsUntilNextLevel()
    {
        return $this->championPointsUntilNextLevel;
    }

    /**
     * Set championPointsSinceLastLevel
     *
     * @param integer $championPointsSinceLastLevel
     *
     * @return ChampionMastery
     */
    public function setChampionPointsSinceLastLevel($championPointsSinceLastLevel)
    {
        $this->championPointsSinceLastLevel = $championPointsSinceLastLevel;

        return $this;
    }

    /**
     * Get championPointsSinceLastLevel
     *
     * @return integer
     */
    public function getChampionPointsSinceLastLevel()
    {
        return $this->championPointsSinceLastLevel;
    }

    /**
     * Set lastPlayTime
     *
     * @param \DateTime $lastPlayTime
     *
     * @return ChampionMastery
     */
    public function setLastPlayTime($lastPlayTime)
    {
        $this->lastPlayTime = $lastPlayTime;

        return $this;
    }

    /**
     * Get lastPlayTime
     *
     * @return \DateTime
     */
    public function getLastPlayTime()
    {
        return $this->lastPlayTime;
    }

    /**
     * Set summoner
     *
     * @param \Psi\AppBundle\Entity\Summoner $summoner
     *
     * @return ChampionMastery
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
