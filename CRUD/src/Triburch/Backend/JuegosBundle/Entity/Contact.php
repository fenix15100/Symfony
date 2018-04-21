<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 21/04/2018
 * Time: 22:09
 */

namespace Triburch\Backend\JuegosBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    private $nombre;

    /**
     * @Assert\Email()
*/
    private $email;

    /**
     * @Assert\Length(max="50",maxMessage="Maximo 50 Caracteres en el asunto")
     */
    private $asunto;
/**
 *
 *  @Assert\Length(max="500",maxMessage="Maximo 500 Caracteres en el mensaje",min="50",minMessage="Minimo 50 Caracteres en el mensaje")
 *
 */

    private $mensaje;

    /**
     * Contact constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     * @return Contact
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed $asunto
     * @return Contact
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $mensaje
     * @return Contact
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
        return $this;
    }



}