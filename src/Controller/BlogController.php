<?php
/**
 * @author: dosim <misstilda@yandex.ru>
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }
}
