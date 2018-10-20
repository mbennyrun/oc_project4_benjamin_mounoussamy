<?php

namespace OC\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@OCLouvres/Default/index.html.twig');
    }
}
