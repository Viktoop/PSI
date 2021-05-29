<?php
namespace Psi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessToken
 *
 * @ORM\Entity()
 * @ORM\Table(name="user_access_token")
 */
class AccessToken
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="Psi\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL"))
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(name="token", type="string", length=256)
     */
    protected $token;

    /**
     * Expired, valid, or other states
     * @var string
     * @ORM\Column(name="state", type="string", length=32)
     */
    protected $state;

    /**
     * @var \DateTime
     * @ORM\Column(name="expires", type="datetime")
     */
    protected $expires;


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
     * Set token
     *
     * @param string $token
     *
     * @return AccessToken
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return AccessToken
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return AccessToken
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set user
     *
     * @param \Psi\UserBundle\Entity\User $user
     *
     * @return AccessToken
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
