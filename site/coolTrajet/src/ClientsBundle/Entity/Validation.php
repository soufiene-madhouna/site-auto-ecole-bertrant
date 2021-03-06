<?php

namespace ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Validation
 *
 * @ORM\Table(name="validation")
 * @ORM\Entity(repositoryClass="ClientsBundle\Repository\ValidationRepository")
 */
class Validation
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
     * @var int
     *
     * @ORM\Column(name="valider", type="integer", nullable=true)
     */
    private $valider;

	/**
	 * @ORM\ManyToOne(targetEntity="ClientsBundle\Entity\Objet", inversedBy="validation")
     * @ORM\JoinColumn(name="objet_id", referencedColumnName="id", nullable=FALSE)
	 */
    private $objet;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransporteursBundle\Entity\Voyage", inversedBy="faireValide")
     * @ORM\JoinColumn(name="voyage_id", referencedColumnName="id", nullable=FALSE)
     */
    private $estVerifie;
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
     * Set valider
     *
     * @param integer $valider
     *
     * @return Validation
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return int
     */
    public function getValider()
    {
        return $this->valider;
    }

    /**
     * Set objet
     *
     * @param \ClientsBundle\Repository\Objet $objet
     *
     * @return Validation
     */
    public function setObjet(\ClientsBundle\Repository\Objet $objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return \ClientsBundle\Repository\Objet
     */
    public function getObjet()
    {
        return $this->objet;
    }

   
    

    /**
     * Set estVerifie
     *
     * @param \TransporteursBundle\Entity\Voyage $estVerifie
     *
     * @return Validation
     */
    public function setEstVerifie(\TransporteursBundle\Entity\Voyage $estVerifie)
    {
        $this->estVerifie = $estVerifie;

        return $this;
    }

    /**
     * Get estVerifie
     *
     * @return \TransporteursBundle\Entity\Voyage
     */
    public function getEstVerifie()
    {
        return $this->estVerifie;
    }
}
