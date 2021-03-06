<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:52
 */

namespace UnaGauchada\PublicationBundle\Model;


use UnaGauchada\PublicationBundle\Entity\Publication;

abstract class PublicationAvailableState
{

    private $publication;

    public function isClosed($publication){
        return true;
    }

    abstract public function isActive($publication);

    public function __construct($publication){
        $this->publication = $publication;
    }

    public function addIfActive($activePublications){
    }

    public function cancel($reason){
        return "";
    }

    /**
     * @return mixed
     */
    public function getPublication()
    {
        return $this->publication;
    }



}