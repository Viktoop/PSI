<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Entity()
 * @ORM\Table(name="user_session")
 */
class Session
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
     * @ORM\Column(name="session_id", type="string", length=128)
     */
    protected $session_id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Psi\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=32)
     */
    protected $status;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updated_at;

    /**
     * @var string
     * @ORM\Column(name="ip_address", type="string", length=16)
     */
    protected $ip_address;


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
     * Set sessionId
     *
     * @param string $sessionId
     *
     * @return Session
     */
    public function setSessionId($sessionId)
    {
        $this->session_id = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Session
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Session
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Session
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return Session
     */
    public function setIpAddress($ipAddress)
    {
        $this->ip_address = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Set user
     *
     * @param \Psi\UserBundle\Entity\User $user
     *
     * @return Session
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
