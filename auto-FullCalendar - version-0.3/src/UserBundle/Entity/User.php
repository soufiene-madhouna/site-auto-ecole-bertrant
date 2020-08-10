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
   
    /** @ORM\OneToMany(targetEntity="AppBundle\Entity\EventCustom", mappedBy="rdv", cascade={"persist","merge","remove"})
     *@ORM\joinColumn(name="utilisateur")
     */
    private $eleve;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

 

  


    /**
     * Add eleve
     *
     * @param \AppBundle\Entity\EventCustom $eleve
     *
     * @return User
     */
    public function addEleve(\AppBundle\Entity\EventCustom $eleve)
    {
        $this->eleve[] = $eleve;

        return $this;
    }

    /**
     * Remove eleve
     *
     * @param \AppBundle\Entity\EventCustom $eleve
     */
    public function removeEleve(\AppBundle\Entity\EventCustom $eleve)
    {
        $this->eleve->removeElement($eleve);
    }

    /**
     * Get eleve
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEleve()
    {
        return $this->eleve;
    }
}
