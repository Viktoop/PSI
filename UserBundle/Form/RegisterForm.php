<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterForm
{

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $password;

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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
}
