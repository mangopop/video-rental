<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FeaturesController extends Controller
{
    //normally with a form, i's built, checked if valid.

    public function createAction()
    {
        // jquery adds new node, on focus out performs action:
        // if we don't have id we come here

        $request = Request::createFromGlobals();
        $task_text = $request->getContent();

        try{
            $feature = new Feature();
            $em = $this->getDoctrine()->getManager();
            $feature->setTask($task_text);
            $feature->setFinished(0);
            $em->persist($feature);
            $em->flush();
            $id = $feature->getId();

            $return = array('id' => $id, 'error' => 200);

        }catch (Exception $e){
            $return = 400;
        }

        $response = json_encode($return); //json encode the array, not necessarily needed
        //return new Response($return, 200, array('Content-Type' => 'application/json')); //make sure it has the correct content type
        return new Response($response); //make sure it has the correct content type
    }

    public function updateAction($id)
    {
        $request = Request::createFromGlobals();
        $task_text = $request->request->get('text'); //don't think this works for json

        try{
            $em = $this->getDoctrine()->getManager();
            $feature = $em->getRepository('AppBundle:Feature')->find($id);
            $feature->setTask($task_text);
            $feature->setFinished(0);
            $em->persist($feature);
            $em->flush();
            //$return = array("responseCode" => 200, 'id' => $id);
            return new Response(
                $id,
                Response::HTTP_OK
            //array('Content-Type' => 'application/json')
            );

        }catch (Exception $e){
//            $return = array("responseCode" => 400);
            return new Response( 'error',  Response::HTTP_EXPECTATION_FAILED);
        }

        //return new Response($return); //make sure it has the correct content type

        //$content = $request->getContent(); //returns raw, not json?
        //$return = json_encode($content);
//        return new Response(
//            $request->request->get('id'), //for POST?
//            //$request->query->get('id'), //for GET stupid fucking idiots!
//            Response::HTTP_OK
//            //array('Content-Type' => 'application/json')
//        );

    }

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $features = $em->getRepository('AppBundle:Feature')->findAll();
        return $this->render(
            'AppBundle:feature:show.html.twig',
            array(
                'features' => $features,
            )
        );
    }

    public function deleteAction($id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $feature = $em->getRepository('AppBundle:Feature')->find($id);
            $em->remove($feature);
            $em->flush();

            return new Response(Response::HTTP_OK);

        }catch (Exception $e){
            return new Response( 'error',  Response::HTTP_EXPECTATION_FAILED);
        }
    }
} 