<?php

namespace DAW\pepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Alumne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DAW\pepeBundle\Entity\AlumneRepository")
 */
class Alumne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", Type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", Type="string", length=40)
     * @Assert\NotBlank(message="El nombre del alumno debe tener nombre")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="observacions", Type="text",nullable=true)
     * @Assert\NotBlank(message="El campo observacion del alumno debe tener conetnido")
     *
     */
    private $observacions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataNaixement", Type="date",nullable=true)
     */
    private $dataNaixement;

    /**
     * @var integer
     *
     * @ORM\Column(name="edat", Type="integer",options={"unsigned"=true})
     * @Assert\NotNull(message="Edat no puede ser nulo")
     * @Assert\Range(min = 0,
     *      max = 100,
     *      minMessage = "La edad no debe ser inferior a  {{ limit }}",
     *      maxMessage = "La edad no debe ser superior a  {{ limit }}")
     */
    private $edat=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="majorEdat", Type="boolean")
     * @Assert\NotNull(message="majorEdat no puede ser nulo")
     *
     */
    private $majorEdat=false;

    /**
     * @var string
     *
     * @ORM\Column(name="notaMitja", Type="decimal",nullable=true,precision=6,scale=2)
     */
    private $notaMitja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataMatriculacion", Type="datetime")
     * @Assert\NotNull(message=" no puede ser nulo")
     */
    private $dataMatriculacion;

    /**
     * Alumne constructor.
     */
    public function __construct()
    {
        $this->dataMatriculacion=new \Datetime;
        $this->dataNaixement=new \Datetime;

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
     * @return Alumne
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
     * Set observacions
     *
     * @param string $observacions
     * @return Alumne
     */
    public function setObservacions($observacions)
    {
        $this->observacions = $observacions;
    
        return $this;
    }

    /**
     * Get observacions
     *
     * @return string 
     */
    public function getObservacions()
    {
        return $this->observacions;
    }

    /**
     * Set dataNaixement
     *
     * @param \DateTime $dataNaixement
     * @return Alumne
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
     * Set edat
     *
     * @param integer $edat
     * @return Alumne
     */
    public function setEdat($edat)
    {
        $this->edat = $edat;
    
        return $this;
    }

    /**
     * Get edat
     *
     * @return integer 
     */
    public function getEdat()
    {
        return $this->edat;
    }

    /**
     * Set majorEdat
     *
     * @param boolean $majorEdat
     * @return Alumne
     */
    public function setMajorEdat($majorEdat)
    {
        $this->majorEdat = $majorEdat;
    
        return $this;
    }

    /**
     * Get majorEdat
     *
     * @return boolean 
     */
    public function getMajorEdat()
    {
        return $this->majorEdat;
    }

    /**
     * Set notaMitja
     *
     * @param string $notaMitja
     * @return Alumne
     */
    public function setNotaMitja($notaMitja)
    {
        $this->notaMitja = $notaMitja;
    
        return $this;
    }

    /**
     * Get notaMitja
     *
     * @return string 
     */
    public function getNotaMitja()
    {
        return $this->notaMitja;
    }

    /**
     * Set dataMatriculacion
     *
     * @param \DateTime $dataMatriculacion
     * @return Alumne
     */
    public function setDataMatriculacion($dataMatriculacion)
    {
        $this->dataMatriculacion = $dataMatriculacion;
    
        return $this;
    }

    /**
     * Get dataMatriculacion
     *
     * @return \DateTime 
     */
    public function getDataMatriculacion()
    {
        return $this->dataMatriculacion;
    }


}
