<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'main_home')]
    public function home(){
        return $this->render('main/home.html.twig');
    }

    #[Route(path: '/test', name: 'main_test')]
    public function test(){
        return $this->render('main/test.html.twig');
    }
}