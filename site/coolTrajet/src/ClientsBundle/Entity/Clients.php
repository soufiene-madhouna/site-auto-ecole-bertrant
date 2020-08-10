<?php

namespace ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="ClientsBundle\Repository\ClientsRepository")
 */
class Clients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=FALSE)
     */
    private $User;
    /**
     * @ORM\OneToMany(targetEntity="ClientsBundle\Entity\Objet", mappedBy="Objets", cascade={"persist","merge","remove"})
     */
    private $Client;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Clients
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Client = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add client
     *
     * @param \ClientsBundle\Entity\Objet $client
     *
     * @return Clients
     */
    public function addClient(\ClientsBundle\Entity\Objet $client)
    {
        $this->Client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \ClientsBundle\Entity\Objet $client
     */
    public function removeClient(\ClientsBundle\Entity\Objet $client)
    {
        $this->Client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->Client;
    }
}
