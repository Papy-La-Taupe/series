<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'main_home')]
    public function home(){
        echo "coucou";
        die();
    }

    #[Route(path: '/test', name: 'main_test')]
    public function test(){
        echo "testounet";
        die();
    }
}