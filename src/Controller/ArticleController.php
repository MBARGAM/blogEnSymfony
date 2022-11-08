<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(): Response
    {

        $tabPairs =[]; // creation d un tableau de nbres pairs et impairs
        $tabString =[]; // creation d'un tableau de string
        $date = new DateTime("08-11-2022") ;

        return $this->render('article/index.html.twig', [
            'titreBlog' => 'Mon Blog',
             'pairsImpairs'=> $tabPairs,
              'tabString'=>  $tabString,
             'date'=> $date->format('y')

        ]);
    }
}
