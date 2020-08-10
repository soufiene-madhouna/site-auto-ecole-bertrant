<?php
// UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected   $id;
   
    /** @ORM\OneToOne(targetEntity="EleveBundle\Entity\Eleve", mappedBy="utilisateur", cascade={"persist","merge","remove"})
     */
    private $eleve;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

 

  

    /**
     * Set eleve
     *
     * @param \EleveBundle\Entity\Eleve $eleve
     *
     * @return User
     */
    public function setEleve(\EleveBundle\Entity\Eleve $eleve)
    {
        $this->eleve = $eleve;

        return $this;
    }

    /**
     * Get eleve
     *
     * @return \EleveBundle\Entity\Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }
}
