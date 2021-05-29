<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Psi\AppBundle\Entity\ImportedAtTrait;

/**
 * Participant
 *
 * @ORM\Entity()
 * @ORM\Table(name="participant",indexes={@ORM\Index(name="search_idx", columns={"summoner_id","team_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class Participant
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
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Match", inversedBy="participants")
     */
    protected $match;

    /**
     *
     * @var RunePage
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\RunePage",cascade={"all"})
     */
    protected $runepage;

    /**
     *
     * @var MasteryPage
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\MasteryPage",cascade={"all"})
     */
    protected $masteryPage;

    /**
     *
     * @var integer
     * @ORM\Column(name="spell_id_1", type="integer")   
     */
    protected $spellId1;

    /**
     *
     * @var integer
     * @ORM\Column(name="spell_id_2", type="integer")  
     */
    protected $spellId2;

    /**
     *
     * @var Team 
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Team")
     */
    protected $team;

    /**
     * @var Summoner 
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Summoner")
     */
    protected $summoner;

    /**
     *
     * @var integer
     * @ORM\Column(name="champion_id", type="integer")  
     */
    protected $championId;

    /**
     *
     * @var string
     * @ORM\Column(name="achieved_season_tier", type="string", nullable=true)  
     */
    protected $highestAchievedSeasonTier;

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

    /**
     * Set spellId1
     *
     * @param integer $spellId1
     *
     * @return Participant
     */
    public function setSpellId1($spellId1)
    {
        $this->spellId1 = $spellId1;

        return $this;
    }

    /**
     * Get spellId1
     *
     * @return integer
     */
    public function getSpellId1()
    {
        return $this->spellId1;
    }

    /**
     * Set spellId2
     *
     * @param integer $spellId2
     *
     * @return Participant
     */
    public function setSpellId2($spellId2)
    {
        $this->spellId2 = $spellId2;

        return $this;
    }

    /**
     * Get spellId2
     *
     * @return integer
     */
    public function getSpellId2()
    {
        return $this->spellId2;
    }

    /**
     * Set championId
     *
     * @param integer $championId
     *
     * @return Participant
     */
    public function setChampionId($championId)
    {
        $this->championId = $championId;

        return $this;
    }

    /**
     * Get championId
     *
     * @return integer
     */
    public function getChampionId()
    {
        return $this->championId;
    }

    /**
     * Set highestAchievedSeasonTier
     *
     * @param string $highestAchievedSeasonTier
     *
     * @return Participant
     */
    public function setHighestAchievedSeasonTier($highestAchievedSeasonTier)
    {
        $this->highestAchievedSeasonTier = $highestAchievedSeasonTier;

        return $this;
    }

    /**
     * Get highestAchievedSeasonTier
     *
     * @return string
     */
    public function getHighestAchievedSeasonTier()
    {
        return $this->highestAchievedSeasonTier;
    }

    /**
     * Set runepage
     *
     * @param \Psi\AppBundle\Entity\RunePage $runepage
     *
     * @return Participant
     */
    public function setRunepage(\Psi\AppBundle\Entity\RunePage $runepage = null)
    {
        $this->runepage = $runepage;

        return $this;
    }

    /**
     * Get runepage
     *
     * @return \Psi\AppBundle\Entity\RunePage
     */
    public function getRunepage()
    {
        return $this->runepage;
    }

    /**
     * Set masteryPage
     *
     * @param \Psi\AppBundle\Entity\MasteryPage $masteryPage
     *
     * @return Participant
     */
    public function setMasteryPage(\Psi\AppBundle\Entity\MasteryPage $masteryPage = null)
    {
        $this->masteryPage = $masteryPage;

        return $this;
    }

    /**
     * Get masteryPage
     *
     * @return \Psi\AppBundle\Entity\MasteryPage
     */
    public function getMasteryPage()
    {
        return $this->masteryPage;
    }

    /**
     * Set team
     *
     * @param \Psi\AppBundle\Entity\Team $team
     *
     * @return Participant
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

    /**
     * Set summoner
     *
     * @param \Psi\AppBundle\Entity\Summoner $summoner
     *
     * @return Participant
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
