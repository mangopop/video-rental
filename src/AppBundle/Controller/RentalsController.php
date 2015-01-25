<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 11/01/15
 * Time: 16:13
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Rentals;
use AppBundle\Form\RentalType;

class RentalsController extends Controller{

    /**
     * displays a form to assign video to user
     * we can pass the id in the url, that route is in users and is user/{id}/video
     *
     */
    public function userAddRentalAction(Request $request, $id)
    {


        /*
         because this form now expects an object (tried to pass number in form doesn't work)
         we're going to have to look at using something like $task->getTags()->add($tag1);
         the original assoc ex should help */

        //may not have to do this if we transform id to object
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        //create a service
        $rentals = $user->getRentals();//can't loop through this
        //$rentals = $user->getRentals()->getTitle();//error

        // ************* show the rentals on the page ******************//

        $rental_details = array();

        $i = 0;
        foreach ($rentals as $rental) {
            $rental_details[$i]['arranged'] = $rental->getArrangedDaysRented();
            $rental_details[$i]['actual'] = $rental->getActualDaysRented();
            $rental_details[$i]['title'] = $rental->getVideo()->getTitle();
            $i ++;
        }

        // ******************* end ************************** //

        $rental = new Rentals();

        //$rental->setUser($user); // expected numeric

        $form = $this->createForm(new RentalType($user), $rental, array(
            'em' => $this->getDoctrine()->getManager(),
            //'data' => $user
        ));

        $form->add('submit', 'submit', array('label' => 'Add Video(s)'));

        //return $form;

//        $form = $this->createFormBuilder($rental)
//            // the rental object only has knowledge of the user as an object - we know we can set this and it can save it (without forms)
//            // we need to find the object first and then pass those details in, that's the preferred way.
//            //$task->getTags()->add($tag1);
//            ->add('user', 'hidden', array('data'=>'1'))
//            ->add('video', 'entity', array(
//                    //'multiple'      => true,
//                    //'expanded'      => true,
//                    'class' => 'AppBundle:Video',
//                    'property' => 'title',
////                    'error_bubbling' => true,
////                    'required' => true,
//                ))
//            ->add('out_date', 'date')
//            ->add('arranged_days_rented', 'integer')
//            ->add('actual_days_rented', 'integer')
//            ->add('save', 'submit', array('label' => 'Add video(s)'))
//            ->getForm();

        //$form->get('user')->setData($user); //expects a numeric, perhaps this is only for unmapped data i.e. 'do you accept checkbox'

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rental);
            $em->flush();

            return $this->redirect($this->generateUrl('_home'));
        }

        return $this->render('AppBundle:default:UserRentalForm.html.twig',array(
                'rentals' => $rental_details,
                'title' => 'Add Rental form',
                'id' => $id,
                'form' => $form->createView(),
            ));
    }

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


    public function userEditRentalAction(Request $request, $id, $rental_id){

        //$rental = new Rentals();

        //...load form with rental data (single) belonging to user

        $em = $this->getDoctrine()->getManager();
        //got problem if load RentalType form with this
        $rental = $em->getRepository('AppBundle:Rentals')->find($rental_id);
        //var_dump($rental);


        $form = $this->createForm(new RentalType(), $rental, array(
                'em' => $this->getDoctrine()->getManager(), //why do I pass this
            ));

        $form->add('submit', 'submit', array('label' => 'Save Edit'));

        //...process form
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rental);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('AppBundle:default:UserRentalForm.html.twig',array(
                'form' => $form->createView(),
                'title' => 'Edit form',
                'id' => $id
            ));
    }
}