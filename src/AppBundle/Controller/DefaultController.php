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

        // if we have properties with a di directional association we should be able access these
        // and get / set from either side

        /*
            $category = new Category();
            $category->setName('Main Products');

            $product = new Product();

            $product->setCategory($category);

            $em->persist($category);
            $em->persist($product);
            $em->flush();
         */

        $em = $this->getDoctrine()->getManager();

        //$user = $em->find('User', 1);
        //$video = $em->find('Video', 1);

        $user = $em->getRepository('AppBundle:User')->find(1);
        $video = $em->getRepository('AppBundle:Video')->find(1);

        $rental = new Rentals();

        $rental->setActualDaysRented(1)
               ->setArrangedDaysRented(3)
               ->setOutDate(new DateTime('01-10-2015'))
               ->setUser($user)
               ->setVideo($video);//should we pass in an object that has been set in one way or all?

        $em->persist($rental);
        $em->flush();


        //change the slash to colon
        return $this->render('AppBundle:default:index.html.twig');
    }


}
