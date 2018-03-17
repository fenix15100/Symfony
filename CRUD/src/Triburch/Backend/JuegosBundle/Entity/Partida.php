<?php

namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Partida
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triburch\Backend\JuegosBundle\Entity\PartidaRepository")
 */
class Partida
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
     * @var \DateTime
     *
     * @ORM\Column(name="quan", type="datetime")
     */
    private $quan;

    /**
     * @var integer
     *
     * @ORM\Column(name="temps", type="integer",options={"unsigned"=true})
     */
    private $temps=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="clicks", type="integer",nullable=true,options={"unsigned"=true})
     * @Assert\NotNull(message="El Campo es obligatorio")
     */
    private $clicks;

    /**
     * @var integer
     *
     * @ORM\Column(name="encerts", type="integer",nullable=true,options={"unsigned"=true})
     */
    private $encerts;

    /**
     * @var integer
     *
     * @ORM\Column(name="errades", type="integer",nullable=true,options={"unsigned"=true})
     */
    private $errades;

    /**
     * @var integer
     *
     * @ORM\Column(name="dificultad", type="integer",nullable=true,options={"unsigned"=true})
     */
    private $dificultad;

    /**
     * @var string
     *
     * @ORM\Column(name="velocitat", type="decimal",nullable=true,precision=6,scale=2)
     */
    private $velocitat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="so", type="boolean")
     * @Assert\NotNull(message="El Campo es obligatorio")
     */
    private $so=false;

    /**
     * @OneToMany(targetEntity="Jugador", mappedBy="Partida")
     *
     */
    private $jugadors;


    /**
     *
     * @ManyToOne(targetEntity="Joc", inversedBy="partidas")
     * @JoinColumn(name="joc_id", referencedColumnName="id")
     */
    private $joc;

    /**
     * Partida constructor.
     */

    public function __construct()
    {
        $this->jugadors=new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set quan
     *
     * @param \DateTime $quan
     * @return Partida
     */
    public function setQuan($quan)
    {
        $this->quan = $quan;
    
        return $this;
    }

    /**
     * Get quan
     *
     * @return \DateTime 
     */
    public function getQuan()
    {
        return $this->quan;
    }

    /**
     * Set temps
     *
     * @param integer $temps
     * @return Partida
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;
    
        return $this;
    }

    /**
     * Get temps
     *
     * @return integer 
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     * @return Partida
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;
    
        return $this;
    }

    /**
     * Get clicks
     *
     * @return integer 
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Set encerts
     *
     * @param integer $encerts
     * @return Partida
     */
    public function setEncerts($encerts)
    {
        $this->encerts = $encerts;
    
        return $this;
    }

    /**
     * Get encerts
     *
     * @return integer 
     */
    public function getEncerts()
    {
        return $this->encerts;
    }

    /**
     * Set errades
     *
     * @param integer $errades
     * @return Partida
     */
    public function setErrades($errades)
    {
        $this->errades = $errades;
    
        return $this;
    }

    /**
     * Get errades
     *
     * @return integer 
     */
    public function getErrades()
    {
        return $this->errades;
    }

    /**
     * Set dificultad
     *
     * @param integer $dificultad
     * @return Partida
     */
    public function setDificultad($dificultad)
    {
        $this->dificultad = $dificultad;
    
        return $this;
    }

    /**
     * Get dificultad
     *
     * @return integer 
     */
    public function getDificultad()
    {
        return $this->dificultad;
    }

    /**
     * Set velocitat
     *
     * @param string $velocitat
     * @return Partida
     */
    public function setVelocitat($velocitat)
    {
        $this->velocitat = $velocitat;
    
        return $this;
    }

    /**
     * Get velocitat
     *
     * @return string 
     */
    public function getVelocitat()
    {
        return $this->velocitat;
    }

    /**
     * Set so
     *
     * @param boolean $so
     * @return Partida
     */
    public function setSo($so)
    {
        $this->so = $so;
    
        return $this;
    }

    /**
     * Get so
     *
     * @return boolean 
     */
    public function getSo()
    {
        return $this->so;
    }

    /**
     * @return mixed
     */
    public function getJugadors()
    {
        return $this->jugadors;
    }

    /**
     * @param mixed $jugadors
     */

    //Añadir un jugador al array
    public function addJugadors( Jugador $jugadors)
    {
        $this->jugadors[] = $jugadors;
    }

    //Setear el array entera
    public function SetJugadors(\Doctrine\Common\Collections\ArrayCollection $jugadors)
    {
        $this->jugadors = $jugadors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJoc()
    {
        return $this->joc;
    }

    /**
     * @param mixed $joc
     */
    public function setJoc($joc): void
    {
        $this->joc = $joc;
    }



}
