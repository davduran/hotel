<?php

namespace ByHours\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ByHours\HotelBundle\Entity\Hotel;
use ByHours\BackendBundle\Form\HotelType;

class HotelController extends Controller
{
    /**
     * List all hotels
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HotelBundle:Hotel')->findAll();

        return $this->render('BackendBundle:Hotel:index.html.twig', array(
            'entities' => $entities
        ));
    }

    public function newAction()
    {
        $entity = new Hotel();
        $form   = $this->createForm(new HotelType(), $entity);

        return $this->render('BackendBundle:Hotel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $entity  = new Hotel();
        $request = $this->getRequest();
        $form    = $this->createForm(new HotelType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Hotel added');

            return $this->redirect($this->generateUrl('backend_hotel'));
        }

        return $this->render('BackendBundle:Hotel:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelBundle:Hotel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Hotel not found');
        }

        $editForm = $this->createForm(new HotelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Hotel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelBundle:Hotel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Hotel not found');
        }

        $editForm   = $this->createForm(new HotelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Hotel modified');

            return $this->redirect($this->generateUrl('backend_hotel'));
        }

        return $this->render('BackendBundle:Hotel:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HotelBundle:Hotel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Hotel not found');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->add('notice', 'Hotel deleted');

        return $this->redirect($this->generateUrl('backend_hotel'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
