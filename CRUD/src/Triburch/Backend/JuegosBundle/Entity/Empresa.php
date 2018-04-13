<?php

namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Triburch\Backend\JuegosBundle\Validators\ValCPos;
use Triburch\Backend\JuegosBundle\Validators\ValIdioma;



/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triburch\Backend\JuegosBundle\Entity\EmpresaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Empresa extends clsAdreces
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="string", length=2)
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcio", type="text", length=510, nullable=true)
     */
    private $descripcio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="userCreated", type="string", length=32)
     */
    private $userCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="userUpdated", type="string", length=32)
     */
    private $userUpdated;

    /**
     * @return string
     */
    public function getCorreu()
    {
        return $this->correu;
    }

    /**
     * @param string $correu
     */
    public function setCorreu($correu)
    {
        $this->correu = $correu;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="correu", type="string", length=50)
     */
    private $correu;

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Empresa
     */
    public function setCreated($created) { $this->created = $created; return $this; }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() { return $this->created; }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Empresa
     */
    public function setUpdated($updated) { $this->updated = $updated; return $this; }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() { return $this->updated; }

    /**
     * Set userCreated
     *
     * @param string $userCreated
     * @return Empresa
     */
    public function setUserCreated($userCreated) { $this->userCreated = $userCreated; return $this; }

    /**
     * Get userCreated
     *
     * @return string
     */
    public function getUserCreated() { return $this->userCreated; }

    /**
     * Set userUpdated
     *
     * @param string $userUpdated
     * @return Empresa
     */
    public function setUserUpdated($userUpdated) { $this->userUpdated = $userUpdated; return $this; }

    /**
     * Get userUpdated
     *
     * @return string
     */
    public function getUserUpdated() { return $this->userUpdated; }

    public function prePersistController($user)
    {
        $this->userUpdated = $user;
        if ($this->userCreated === null) $this->userCreated = $user;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersist()
    {
        $this->updated = new \DateTime();
        if ($this->created === null) $this->created = $this->updated;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Empresa
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Empresa
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
     * Set idioma
     *
     * @param string $idioma
     * @return Empresa
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
     * Set descripcio
     *
     * @param string $descripcio
     * @return Empresa
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Get descripcio
     *
     * @return string
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('nom', new Assert\Length(array('max' => 50)));
        $metadata->addPropertyConstraint('adresa', new Assert\NotBlank());
        $metadata->addPropertyConstraint('poblacio', new Assert\NotBlank());
        $metadata->addPropertyConstraint('poblacio', new Assert\Length(array('max' => 50)));
        $metadata->addPropertyConstraint('cp', new ValCPos);
        $metadata->addPropertyConstraint('correu', new Assert\NotBlank());
        $metadata->addPropertyConstraint('correu', new Assert\Email());
        $metadata->addPropertyConstraint('idioma', new ValIdioma());
        $metadata->addPropertyConstraint('descripcio', new Assert\Length(array('max' => 510)));
        $metadata->addConstraint(new UniqueEntity(array(
            "fields" => "nom",
            "message" => "Nombre duplicado")));
    }
}