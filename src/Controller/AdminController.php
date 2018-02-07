<?php
/**
 * Created by PhpStorm.
 * User: huber
 * Date: 07/02/2018
 * Time: 16:00
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     *
     * @param Environment $twig
     * @return Response
     */
    public function adminAction(Environment $twig)
    {
        return new Response('<h1>Coucou, module d\'administration</h1>');
    }

}