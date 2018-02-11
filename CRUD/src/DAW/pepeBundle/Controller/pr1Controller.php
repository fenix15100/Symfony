<?php

namespace DAW\pepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Datetime;

class pr1Controller extends Controller
{
    public function pr1Action($string)
    {
        $vector=explode(",",$string);
        $fecha=substr($vector[2],0,4).'-'.substr($vector[2],4,2).'-'.substr($vector[2],6,2);
        $vector[2]=$fecha;

        return $this->render('DAWpepeBundle:pr1:pr1.html.twig', array('vector'=>$vector));    }

}
