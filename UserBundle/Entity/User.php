<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
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
     * @ORM\Column(name="name", type="string", length=64)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=128)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=64)
     */
    protected $status;
    
    /**
     * @var Role[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Psi\UserBundle\Entity\Role") 
     * @ORM\JoinTable(name="user_roles")
     */
    protected $roles;
    

    /**
     * @var string
     * @ORM\Column(name="salt", type="string", length=40)
     */
    protected $salt;    

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=128)
     */
    protected $password;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var \DateTime
     * @ORM\Column(name="password_reset_request_at", type="datetime", nullable=true)
     */
    protected $passwordRequestAt;    
    
    /**
     * Register confirmation access token
     * @var AccessToken
     * @ORM\OneToOne(targetEntity="Psi\UserBundle\Entity\AccessToken")
     */
    protected $confirmationToken;
    
    /**
     * Last generated password reset access token
     * @var AccessToken
     * @ORM\OneToOne(targetEntity="Psi\UserBundle\Entity\AccessToken")
     */    
    protected $resetToken;
    
    /**
     * Additional serialized data
     * @var string
     * @ORM\Column(name="additional_data", type="text", nullable=true)
     */    
    protected $additionalData;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return User
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
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set passwordRequestAt
     *
     * @param \DateTime $passwordRequestAt
     *
     * @return User
     */
    public function setPasswordRequestAt($passwordRequestAt)
    {
        $this->passwordRequestAt = $passwordRequestAt;

        return $this;
    }

    /**
     * Get passwordRequestAt
     *
     * @return \DateTime
     */
    public function getPasswordRequestAt()
    {
        return $this->passwordRequestAt;
    }

    /**
     * Set additionalData
     *
     * @param string $additionalData
     *
     * @return User
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;

        return $this;
    }

    /**
     * Get additionalData
     *
     * @return string
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * Add role
     *
     * @param \Psi\UserBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\Psi\UserBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Psi\UserBundle\Entity\Role $role
     */
    public function removeRole(\Psi\UserBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set confirmationToken
     *
     * @param \Psi\UserBundle\Entity\AccessToken $confirmationToken
     *
     * @return User
     */
    public function setConfirmationToken(\Psi\UserBundle\Entity\AccessToken $confirmationToken = null)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return \Psi\UserBundle\Entity\AccessToken
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set resetToken
     *
     * @param \Psi\UserBundle\Entity\AccessToken $resetToken
     *
     * @return User
     */
    public function setResetToken(\Psi\UserBundle\Entity\AccessToken $resetToken = null)
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    /**
     * Get resetToken
     *
     * @return \Psi\UserBundle\Entity\AccessToken
     */
    public function getResetToken()
    {
        return $this->resetToken;
    }
}
