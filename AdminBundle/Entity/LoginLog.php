<?php
namespace Psi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoginLog
 *
 * @ORM\Entity()
 * @ORM\Table(name="login_log",indexes={@ORM\Index(name="search_idx", columns={"email","login_date"})})
 */
class LoginLog
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
     * @ORM\Column(name="email", type="string", length=128)
     */    
    protected $email;
    
    /**
     * @var string
     * @ORM\Column(name="login_result", type="string", length=32)
     */    
    protected $login_result;
    
    /**
     * @var string
     * @ORM\Column(name="login_date", type="datetime")
     */    
    protected $login_date;
    
    /**
     * @var string
     * @ORM\Column(name="ip_address", type="string", length=16)
     */    
    protected $ip_address;
    
    /**
     * @var string
     * @ORM\Column(name="session_id", type="string", length=128)
     */      
    protected $session_id;


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
     * Set email
     *
     * @param string $email
     *
     * @return LoginLog
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
     * Set loginResult
     *
     * @param string $loginResult
     *
     * @return LoginLog
     */
    public function setLoginResult($loginResult)
    {
        $this->login_result = $loginResult;

        return $this;
    }

    /**
     * Get loginResult
     *
     * @return string
     */
    public function getLoginResult()
    {
        return $this->login_result;
    }

    /**
     * Set loginDate
     *
     * @param \DateTime $loginDate
     *
     * @return LoginLog
     */
    public function setLoginDate($loginDate)
    {
        $this->login_date = $loginDate;

        return $this;
    }

    /**
     * Get loginDate
     *
     * @return \DateTime
     */
    public function getLoginDate()
    {
        return $this->login_date;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return LoginLog
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
     * Set sessionId
     *
     * @param string $sessionId
     *
     * @return LoginLog
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
}
