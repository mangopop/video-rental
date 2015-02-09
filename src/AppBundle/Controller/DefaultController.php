<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class DefaultController extends Controller
{

    public function indexAction()
    {
        //change the slash to colon
        return $this->render('AppBundle:default:index.html.twig');
    }

    public function testAction(){
        if (!$this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        return $this->render('AppBundle:default:test.html.twig');

        


    }

    public function addRoleAction(){
        //add ROLE_EDITOR to user 2
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find(2);
        $role = $em->getRepository('AppBundle:Role')->find(3);

        //we don't have addRole() on user to how do we do this? one way?
        //$user->addRole($role);
        $role->addUser($user);
        $user->addRole($role);
        $em->persist($role);
        $em->persist($user);
        $em->flush();

        return new Response('add role page');
    }

    public function jsonAction(){


        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(array('rentals'));
        $serializer = new Serializer(array($normalizer), array($encoder));


        $em = $this->getDoctrine()->getManager();

        //$user = $em->find('User', 1);
        //$video = $em->find('Video', 1);

        //$user = $em->getRepository('AppBundle:User')->findAll();
        $video = $em->getRepository('AppBundle:Video')->findAll();

        $jsonContent = $serializer->serialize($video, 'json');

        //echo $jsonContent; // or return it in a Response
        return new Response($jsonContent);
//        return $this->render('AppBundle:default:test.html.twig',array(
//                'json' => $jsonContent,
//            ));


    }

    public function featuresAction(){
        return $this->render('AppBundle:default:features.html.twig');
    }

}
