<?php

namespace DAW\pepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DAWpepeBundle:Default:index.html.twig', array('name' => $name));
    }

    public function articulosAction(){
        $articulos = array(
            array('id' => 1, 'title' => 'Articulo numero 1', 'created' => '2011-01-01'),
            array('id' => 2, 'title' => 'Articulo numero 2', 'created' => '2011-01-01'),
            array('id' => 3, 'title' => 'Articulo numero 3', 'created' => '2011-01-01'),
        );
        return $this->render('DAWpepeBundle:Default:articulos.html.twig', array('articulos' => $articulos));
    }

    public function articuloAction($id){
        $articulos = array(
            array('id' => 1, 'title' => 'Articulo numero 1', 'created' => '2011-01-01'),
            array('id' => 2, 'title' => 'Articulo numero 2', 'created' => '2011-01-01'),
            array('id' => 3, 'title' => 'Articulo numero 3', 'created' => '2011-01-01'),
        );

        $articuloSeleccionado = null;
        foreach($articulos as $articulo)
        {
            if($articulo['id'] == $id)
            {
                $articuloSeleccionado = $articulo;
                break;
            }
        }

        return $this->render('DAWpepeBundle:Default:articulo.html.twig', array('articulo' => $articuloSeleccionado));

    }






}
