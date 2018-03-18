<?php

namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Jugador
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triburch\Backend\JuegosBundle\Entity\JugadorRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="nick_unique",columns={"nick"})})
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
     * @ORM\Column(name="nom", type="string", length=40)
     * @Assert\NotBlank(message="El Campo es obligatorio")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cognom1", type="string", length=40)
     * @Assert\NotBlank(message="El Campo es obligatorio")
     */
    private $cognom1;

    /**
     * @var string
     *
     * @ORM\Column(name="cognom2", type="string", length=40,nullable=true)
     * @Assert\NotBlank(message="El Campo es obligatorio" )
     */
    private $cognom2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataNaixement", type="date",nullable=true)
     *
     */
    private $dataNaixement;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostic", type="text",length=60000,nullable=true)
     */
    private $diagnostic;

    /**
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=40,nullable=true)
     */
    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="string", length=4,nullable=true)
     * @Assert\Language()
     */
    private $idioma;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actiu", type="boolean")
     *
     */
    private $actiu=true;



    /**
     *
     * @ManyToOne(targetEntity="Partida", inversedBy="jugadors")
     * @JoinColumn(name="partida_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $partida;



    /**
     * Jugador constructor.
     * @param \DateTime $dataNaixement */

    public function __construct()
    {
        $this->dataNaixement = new \Datetime;
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
     * Set cognom1
     *
     * @param string $cognom1
     * @return Jugador
     */
    public function setCognom1($cognom1)
    {
        $this->cognom1 = $cognom1;
    
        return $this;
    }

    /**
     * Get cognom1
     *
     * @return string 
     */
    public function getCognom1()
    {
        return $this->cognom1;
    }

    /**
     * Set cognom2
     *
     * @param string $cognom2
     * @return Jugador
     */
    public function setCognom2($cognom2)
    {
        $this->cognom2 = $cognom2;
    
        return $this;
    }

    /**
     * Get cognom2
     *
     * @return string 
     */
    public function getCognom2()
    {
        return $this->cognom2;
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

    /**
     * Set diagnostic
     *
     * @param string $diagnostic
     * @return Jugador
     */
    public function setDiagnostic($diagnostic)
    {
        $this->diagnostic = $diagnostic;
    
        return $this;
    }

    /**
     * Get diagnostic
     *
     * @return string 
     */
    public function getDiagnostic()
    {
        return $this->diagnostic;
    }

    /**
     * Set nick
     *
     * @param string $nick
     * @return Jugador
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    
        return $this;
    }

    /**
     * Get nick
     *
     * @return string 
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Jugador
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    
        return $this;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set actiu
     *
     * @param boolean $actiu
     * @return Jugador
     */
    public function setActiu($actiu)
    {
        $this->actiu = $actiu;
    
        return $this;
    }

    /**
     * Get actiu
     *
     * @return boolean 
     */
    public function getActiu()
    {
        return $this->actiu;
    }

    /**
     * @return mixed
     */
    public function getPartida()
    {
        return $this->partida;
    }

    /**
     * @param mixed $partida
     */
    public function setPartida($partida): void
    {
        $this->partida = $partida;
    }


}
