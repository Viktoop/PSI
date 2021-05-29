<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Psi\AppBundle\Entity\ImportedAtTrait;
use Psi\AppBundle\Entity\ExternalIdTrait;

/**
 * Match
 *
 * @ORM\Entity()
 * @ORM\Table(name="game_match",indexes={@ORM\Index(name="search_idx", columns={"external_id","created_at"})})
 * @ORM\HasLifecycleCallbacks
 */
class Match
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
     * @var Participant[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Psi\AppBundle\Entity\Participant", mappedBy="match",cascade={"all"})
     */
    protected $participants;

    /**
     *
     * @var string
     *  @ORM\Column(name="version", type="string", nullable=true) 
     */
    protected $version;

    /**
     *
     * @var integer
     * @ORM\Column(name="map_id", type="integer") 
     */
    protected $mapId;

    /**
     * @var string
     * @ORM\Column(name="duration", type="bigint", nullable=true)
     */
    protected $duration;

    /**
     *
     * @var string
     * @ORM\Column(name="season", type="string", nullable=true)
     */
    protected $season;

    /**
     *
     * @var string 
     * @ORM\Column(name="queue_type", type="string")
     */
    protected $queueType;

    /**
     *
     * @var string 
     * @ORM\Column(name="match_type", type="string")
     */
    protected $matchType;

    /**
     * @var string
     * @ORM\Column(name="region", type="string")
     */
    protected $region;

    /**
     *
     * @var Team[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Psi\AppBundle\Entity\Team", mappedBy="match",cascade={"all"}) 
     */
    protected $teams;

    /**
     * @var bool
     * @ORM\Column(name="archived", type="boolean")
     */
    protected $archived;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime") 
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set version
     *
     * @param string $version
     *
     * @return Match
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set mapId
     *
     * @param integer $mapId
     *
     * @return Match
     */
    public function setMapId($mapId)
    {
        $this->mapId = $mapId;

        return $this;
    }

    /**
     * Get mapId
     *
     * @return integer
     */
    public function getMapId()
    {
        return $this->mapId;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Match
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set season
     *
     * @param string $season
     *
     * @return Match
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set queueType
     *
     * @param string $queueType
     *
     * @return Match
     */
    public function setQueueType($queueType)
    {
        $this->queueType = $queueType;

        return $this;
    }

    /**
     * Get queueType
     *
     * @return string
     */
    public function getQueueType()
    {
        return $this->queueType;
    }

    /**
     * Set matchType
     *
     * @param string $matchType
     *
     * @return Match
     */
    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;

        return $this;
    }

    /**
     * Get matchType
     *
     * @return string
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Match
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Match
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Match
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add participant
     *
     * @param \Psi\AppBundle\Entity\Participant $participant
     *
     * @return Match
     */
    public function addParticipant(\Psi\AppBundle\Entity\Participant $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \Psi\AppBundle\Entity\Participant $participant
     */
    public function removeParticipant(\Psi\AppBundle\Entity\Participant $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Add team
     *
     * @param \Psi\AppBundle\Entity\Team $team
     *
     * @return Match
     */
    public function addTeam(\Psi\AppBundle\Entity\Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \Psi\AppBundle\Entity\Team $team
     */
    public function removeTeam(\Psi\AppBundle\Entity\Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
