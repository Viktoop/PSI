<?php
// Marko Mrkonjic - 3139/2016

namespace Psi\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CacheTag
 *
 * @ORM\Entity()
 * @ORM\Table(name="cache_tag",indexes={@ORM\Index(name="search_idx", columns={"tag"})})
 */
class CacheTag
{
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
     * @ORM\Column(name="tag", type="string")
     */     
    protected $tag;
    
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Psi\AppBundle\Entity\Cache")
     */        
    protected $cache;

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
     * Set tag
     *
     * @param string $tag
     *
     * @return CacheTag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set cache
     *
     * @param \Psi\AppBundle\Entity\Cache $cache
     *
     * @return CacheTag
     */
    public function setCache(\Psi\AppBundle\Entity\Cache $cache = null)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * Get cache
     *
     * @return \Psi\AppBundle\Entity\Cache
     */
    public function getCache()
    {
        return $this->cache;
    }
}
