<?php


namespace Triburch\Backend\JuegosBundle\Validators;
use Symfony\Component\Validator\Constraint;


class ValIdioma extends Constraint
{
    public $message;

    public function __construct()
    {
        $this->message = "Idioma Invalido";
    }
}