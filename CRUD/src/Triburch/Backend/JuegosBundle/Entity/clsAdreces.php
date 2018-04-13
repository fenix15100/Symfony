<?php


namespace Triburch\Backend\JuegosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class clsAdreces
{
    /**
     * @var string
     * @ORM\Column(name="adresa", type="string",length=50)
     */
    protected $adresa;
    /**
     * @var string
     * @ORM\Column(name="cp",type="string",length=5)
     */
    protected $cp;
    /**
     * @var string
     * @ORM\Column(name="poblacio",type="string",length=50)
     */
    protected $poblacio;

    /**
     * @return mixed
     */
    public function getAdresa()
    {
        return $this->adresa;
    }

    /**
     * @param mixed $adresa
     */
    public function setAdresa($adresa)
    {
        $this->adresa = $adresa;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getPoblacio()
    {
        return $this->poblacio;
    }

    /**
     * @param mixed $poblacio
     */
    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;
    }

}