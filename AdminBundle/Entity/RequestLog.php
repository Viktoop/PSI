<?php
namespace Psi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestLog
 *
 * @ORM\Entity()
 * @ORM\Table(name="request_log",indexes={@ORM\Index(name="search_idx", columns={"request_date"})})
 */
class RequestLog
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
     * @ORM\Column(name="request_url", type="string", length=2048)
     */
    protected $request_url;
    
    /**
     * @var string
     * @ORM\Column(name="remote_address", type="string", length=16)
     */    
    protected $remote_address;
    
    /**
     * @var string
     * @ORM\Column(name="http_referer", type="blob")
     */    
    protected $http_referer;
    
    /**
     * @var resource
     * @ORM\Column(name="user_agent", type="blob")
     */       
    protected $user_agent;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="request_date", type="datetime")
     */        
    protected $request_date;
    

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
     * Set requestUrl
     *
     * @param string $requestUrl
     *
     * @return RequestLog
     */
    public function setRequestUrl($requestUrl)
    {
        $this->request_url = $requestUrl;

        return $this;
    }

    /**
     * Get requestUrl
     *
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->request_url;
    }

    /**
     * Set remoteAddress
     *
     * @param string $remoteAddress
     *
     * @return RequestLog
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
     * Set httpReferer
     *
     * @param string $httpReferer
     *
     * @return RequestLog
     */
    public function setHttpReferer($httpReferer)
    {
        $this->http_referer = $httpReferer;

        return $this;
    }

    /**
     * Get httpReferer
     *
     * @return string
     */
    public function getHttpReferer()
    {
        return $this->http_referer;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return RequestLog
     */
    public function setUserAgent($userAgent)
    {
        $this->user_agent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }

    /**
     * Set requestDate
     *
     * @param \DateTime $requestDate
     *
     * @return RequestLog
     */
    public function setRequestDate($requestDate)
    {
        $this->request_date = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->request_date;
    }
}
