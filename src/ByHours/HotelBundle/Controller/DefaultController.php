<?php

namespace ByHours\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HotelBundle:Default:index.html.twig');
    }

    public function viewAction($hotel)
    {
        return $this->render('HotelBundle:Default:view.html.twig');
    }

    public function bookingAction($hotel, $room)
    {
        return $this->render('HotelBundle:Default:booking.html.twig');
    }
}
