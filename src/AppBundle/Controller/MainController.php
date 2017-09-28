<?php
/**
 * Created by PhpStorm.
 * User: Толик
 * Date: 28.09.2017
 * Time: 16:01
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}