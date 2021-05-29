<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Entity;

use Psi\AppBundle\Entity\ImportedAtTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * ChampionCache
 *
 * @ORM\Entity()
 * @ORM\Table(name="champion_cache")
 * @ORM\HasLifecycleCallbacks
 */
class ChampionCache
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
     *
     * @var integer 
     * @ORM\Column(name="champion_id", type="integer")
     */
    protected $championId;

    /**
     *
     * @var string
     * @ORM\Column(name="cache_tag", type="string") 
     */
    protected $cacheTag;

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
     * Set championId
     *
     * @param integer $championId
     *
     * @return ChampionCache
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
     * Set cacheTag
     *
     * @param string $cacheTag
     *
     * @return ChampionCache
     */
    public function setCacheTag($cacheTag)
    {
        $this->cacheTag = $cacheTag;

        return $this;
    }

    /**
     * Get cacheTag
     *
     * @return string
     */
    public function getCacheTag()
    {
        return $this->cacheTag;
    }
}
