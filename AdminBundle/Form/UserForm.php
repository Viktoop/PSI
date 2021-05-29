<?php
// Viktor Galindo - 655/2013
namespace Psi\AdminBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class UserForm
{

    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     * @var string
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $firstname;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $password;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $purchaseOrderNumber;

    /**
     *
     * @var type 
     */
    protected $additionalData;

    /**
     * @var string 
     */
    protected $summonerName;

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSummonerName()
    {
        return $this->summonerName;
    }

    public function getPurchaseOrderNumber()
    {
        return $this->purchaseOrderNumber;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setPurchaseOrderNumber($purchaseOrderNumber)
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;
        return $this;
    }

    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    public function setSummonerName($summonerName)
    {
        $this->summonerName = $summonerName;
        return $this;
    }
}
