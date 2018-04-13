<?php

namespace Triburch\Backend\JuegosBundle\Validators;

use Symfony\Component\Validator\Constraint;

class ValCPos extends Constraint
{
    public $message;

	public function __construct()
	{
		$this->message = "Codigo Postal incorrecto";
	}
}
