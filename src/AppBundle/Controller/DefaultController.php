<?php

namespace AppBundle\Controller;

use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rentals;
use AppBundle\Entity\Video;
use AppBundle\Entity\User;

class DefaultController extends Controller
{

    public function indexAction()
    {
        //...load some

        //change the slash to colon
        return $this->render('AppBundle:default:index.html.twig');
    }


}
