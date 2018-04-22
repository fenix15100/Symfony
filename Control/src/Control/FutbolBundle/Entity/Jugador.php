<?php

namespace Control\FutbolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugador
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Control\FutbolBundle\Entity\JugadorRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="nomjujador_unique",columns={"nom"})})
 */
class Jugador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=120)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="equip", type="string", length=120)
     */
    private $equip;

    /**
     * @var integer
     *
     * @ORM\Column(name="gols", type="integer")
     */
    private $gols;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_naixement", type="date")
     */
    private $dataNaixement;


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
     * Set nom
     *
     * @param string $nom
     * @return Jugador
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set equip
     *
     * @param string $equip
     * @return Jugador
     */
    public function setEquip($equip)
    {
        $this->equip = $equip;
    
        return $this;
    }

    /**
     * Get equip
     *
     * @return string 
     */
    public function getEquip()
    {
        return $this->equip;
    }

    /**
     * Set gols
     *
     * @param integer $gols
     * @return Jugador
     */
    public function setGols($gols)
    {
        $this->gols = $gols;
    
        return $this;
    }

    /**
     * Get gols
     *
     * @return integer 
     */
    public function getGols()
    {
        return $this->gols;
    }

    /**
     * Set dataNaixement
     *
     * @param \DateTime $dataNaixement
     * @return Jugador
     */
    public function setDataNaixement($dataNaixement)
    {
        $this->dataNaixement = $dataNaixement;
    
        return $this;
    }

    /**
     * Get dataNaixement
     *
     * @return \DateTime 
     */
    public function getDataNaixement()
    {
        return $this->dataNaixement;
    }
}
