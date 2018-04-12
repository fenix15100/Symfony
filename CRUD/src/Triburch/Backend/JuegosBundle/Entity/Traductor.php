<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 12/04/2018
 * Time: 22:06
 */

namespace Triburch\Backend\JuegosBundle\Entity;


class Traductor
{
    private $es;

    private $ca;

    private $fr;

    private $en;


    /**
     * @return mixed
     */
    public function getEs()
    {
        return $this->es;
    }

    /**
     * @param mixed $es
     */
    public function setEs($es)
    {
        $this->es = $es;
    }

    /**
     * @return mixed
     */
    public function getCa()
    {
        return $this->ca;
    }

    /**
     * @param mixed $ca
     */
    public function setCa($ca)
    {
        $this->ca = $ca;
    }

    /**
     * @return mixed
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * @param mixed $fr
     */
    public function setFr($fr)
    {
        $this->fr = $fr;
    }

    /**
     * @return mixed
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * @param mixed $en
     */
    public function setEn($en)
    {
        $this->en = $en;
    }


    public function getArrayTraduction(){

        return
            array('es_ES'=>$this->es,'ca'=>$this->ca,'fr'=>$this->fr,'en'=>$this->en);


    }







}