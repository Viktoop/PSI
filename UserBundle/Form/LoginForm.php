<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class LoginForm
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
}
