<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:53
 */

namespace UnaGauchada\PublicationBundle\Model;


use UnaGauchada\PublicationBundle\Entity\Publication;

class AvailableState extends PublicationAvailableState
{

    public function addIfActive($activePublications){
        $this->getPublication()->getSubmissionsState()->addAvailableIfActive($activePublications);
    }

    public function cancel($reason){
        return $this->getPublication()->getSubmissionsState()->cancel($reason);
    }

    public function isClosed($publication){
        return $publication->getSubmissionsState()->isClosed();
    }

    public function isActive($publication){
        return $publication->getSubmissionsState()->isActive();
    }

}