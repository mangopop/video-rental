<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 11/01/15
 * Time: 16:13
 */

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use AppBundle\Form\Video_userType;
use AppBundle\Entity\UserVideos;
use AppBundle\Entity\Video;
use Symfony\Component\HttpFoundation\Request;

class VideoUserController extends Controller{

    /**
     * displays a form to assign video to user
     * we can pass the id in the url, that route is in users and is user/{id}/video
     *
     */
    public function userAddVideoAction(Request $request, $id)
    {

        //$videos = $em->findAll('User');
        $emanager = $this->getDoctrine()->getManager();
        $videos = $emanager->getRepository('AppBundle:Video')->findAll();

        $user_video = new UserVideos();
        $user_video->setUserId($id);

        $form = $this->createFormBuilder($user_video)
            ->add('user_id', 'hidden')
            ->add('video_id', 'entity', array(
                    //'multiple'      => true,
                    //'expanded'      => true,
                    'class' => 'AppBundle:Video',
                    'property' => 'title',

//                    'error_bubbling' => true,
//                    'required' => true,
                ))
            ->add('out_date', 'date')
            ->add('arranged_days_rented', 'integer')
            ->add('save', 'submit', array('label' => 'Add video(s)'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user_video);
            $em->flush();

            return $this->redirect($this->generateUrl('/'));
        }

        return $this->render('AppBundle:default:newUserVideo.html.twig',array(
                'videos' => $videos,
                'form' => $form->createView(),
            ));

    }



        //option 2

//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('AppBundle:User')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find video_user entity.');
//        }
//
//        $editForm = $this->createAddUserVideoForm($entity);
//
//
//        return $this->render('AppBundle:User:addUserVideo.html.twig', array(
//                'entity'      => $entity,
//                'edit_form'   => $editForm->createView(),
//            ));

//    }

    // This should build a checklist form with all videos
    // user id should be hidden
//    public function createAddUserVideoForm(Video_user $entity){
//        $form = $this->createForm(new Video_userType(), $entity, array(
//                'action' => $this->generateUrl('video_update', array('id' => $entity->getId())),
//                'method' => 'PUT',
//            ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }
} 