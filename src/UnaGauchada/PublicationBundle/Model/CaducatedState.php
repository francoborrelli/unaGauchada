<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:53
 */

namespace UnaGauchada\PublicationBundle\Model;


class CaducatedState extends PublicationAvailableState
{
    public function isActive($publication){
        return false;
    }
}