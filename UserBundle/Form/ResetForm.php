<?php
// Marko Mrkonjic - 3139/2016
namespace Psi\UserBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class ResetForm
{

    /**
     * @Assert\NotBlank()
     * @var string
     */
    protected $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
