<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User Implements UserInterface, \ Serializable

// Userinterface must implement this
// getRoles()
// getPassword()
// getSalt()
// getUsername()
// eraseCredentials()

{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Rentals", mappedBy="user",cascade={"remove"})
     */
    protected $rentals;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     *
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rentals = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
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
     * Set password
     *
     * @param string $password
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
     * Set email
     *
     * @param string $email
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
     * Add rentals
     *
     * @param \AppBundle\Entity\Rentals $rentals
     * @return User
     */
    public function addRental(\AppBundle\Entity\Rentals $rental)
    {
        $this->rentals[] = $rental;

        return $this;
    }

    /**
     * Remove rentals
     *
     * @param \AppBundle\Entity\Rentals $rentals
     */
    public function removeRentals(\AppBundle\Entity\Rentals $rental)
    {
        $this->rentals->removeElement($rental);
    }

    /**
     * Get rentals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRentals()
    {
        return $this->rentals;
    }




                            ////---------------------------////
    ////////////////////////////-------- SECURITY ---------/////////////////////////////
                            ////---------------------------////

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    //note, add remove was required and the naming (not plural and add/remove) is important

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $roles
     * @return Role
     */
    public function addRole(\AppBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \AppBundle\Entity\Role $roles
     */
    public function removeRole(\AppBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }


    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
                $this->id,
                $this->username,
                $this->password,
                // see section on salt below
                // $this->salt,
            ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
