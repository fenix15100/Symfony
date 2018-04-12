<?php

namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Joc
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triburch\Backend\JuegosBundle\Entity\JocRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="nomjoc_unique",columns={"nom"})})
 */
class Joc
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
     * @ORM\Column(name="imatge", type="string", length=100,nullable=true)
     *
     */
    private $imatge;



    /**
     *
     * @ManyToOne(targetEntity="Categoria", inversedBy="jocs")
     * @JoinColumn(name="categoria_id", referencedColumnName="id",onDelete="CASCADE")
     * @Assert\NotNull(message="El Campo es obligatorio")
     */
    private $categoria;


    /**
     *
     * @OneToMany(targetEntity="Partida", mappedBy="joc")
     */
    private $partidas;


    /**
     * @ORM\Column(name="array_trans", type="array",nullable=true)
     *
     */
    private $arrayTrans;
    /**
     * Joc constructor.
     */
    public function __construct()
    {
        $this->partidas=new ArrayCollection();
        $this->arrayTrans=array('es_ES'=>null,'ca'=>null,'fr'=>null,'en'=>null);

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
     * @return Joc
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
     * Set imatge
     *
     * @param string $imatge
     * @return Joc
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    
        return $this;
    }

    /**
     * Get imatge
     *
     * @return string 
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria( Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getPartidas()
    {
        return $this->partidas;
    }




    public function addPartidas(Partida $partida){
        $this->partidas[]=$partida;
    }

    /**
     * @return mixed
     */
    public function getArrayTrans()
    {
        return $this->arrayTrans;
    }

    /**
     * @param mixed $arrayTrans
     */
    public function setArrayTrans(Traductor $arrayTrans)
    {
        $this->arrayTrans = $arrayTrans->getArrayTraduction();
    }




    public function __toString(){
        return $this->getNom();
    }



}
