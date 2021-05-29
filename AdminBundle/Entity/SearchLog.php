<?php
namespace Psi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SearchLog
 *
 * @ORM\Entity()
 * @ORM\Table(name="search_log",indexes={@ORM\Index(name="search_idx", columns={"search_date"})})
 */
class SearchLog
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
     * @ORM\Column(name="query", type="string", length=256)
     */    
    protected $query;
    
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Psi\UserBundle\Entity\User")
     */    
    protected $user;
    
    /**
     * @var string
     * @ORM\Column(name="remote_address", type="string", length=16)
     */    
    protected $remote_address;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="search_date", type="datetime")
     */    
    protected $search_date;
    

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
     * Set query
     *
     * @param string $query
     *
     * @return SearchLog
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set remoteAddress
     *
     * @param string $remoteAddress
     *
     * @return SearchLog
     */
    public function setRemoteAddress($remoteAddress)
    {
        $this->remote_address = $remoteAddress;

        return $this;
    }

    /**
     * Get remoteAddress
     *
     * @return string
     */
    public function getRemoteAddress()
    {
        return $this->remote_address;
    }

    /**
     * Set searchDate
     *
     * @param \DateTime $searchDate
     *
     * @return SearchLog
     */
    public function setSearchDate($searchDate)
    {
        $this->search_date = $searchDate;

        return $this;
    }

    /**
     * Get searchDate
     *
     * @return \DateTime
     */
    public function getSearchDate()
    {
        return $this->search_date;
    }

    /**
     * Set user
     *
     * @param \Psi\UserBundle\Entity\User $user
     *
     * @return SearchLog
     */
    public function setUser(\Psi\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Psi\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
