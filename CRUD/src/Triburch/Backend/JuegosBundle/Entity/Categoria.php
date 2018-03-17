<?php

namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triburch\Backend\JuegosBundle\Entity\CategoriaRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="nom_unique",columns={"nom"})})
 */
class Categoria
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="treballa", type="text",length=60000)
     *
     * @Assert\NotBlank(message="El Campo es obligatorio")
     */
    private $treballa;




    /**
     * @OneToMany(targetEntity="Joc", mappedBy="Categoria")
     *
     */
    private $jocs;

    /**
     * Categoria constructor.
     *
     */
    public function __construct()
    {
        $this->jocs=new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Categoria
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
     * Set treballa
     *
     * @param string $treballa
     * @return Categoria
     */
    public function setTreballa($treballa)
    {
        $this->treballa = $treballa;
    
        return $this;
    }

    /**
     * Get treballa
     *
     * @return string 
     */
    public function getTreballa()
    {
        return $this->treballa;
    }

    /**
     * @return mixed
     */
    public function getJocs()
    {
        return $this->jocs;
    }

    /**
     * @param mixed $jocs
     */
    public function setJocs(\Doctrine\Common\Collections\ArrayCollection $jocs)
    {
        $this->jocs = $jocs;
    }

    public function addJocs(Joc $joc){
        $this->jocs[]=$joc;
    }

}
