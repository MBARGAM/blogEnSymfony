<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;
use DateTime;


class ArticleController extends AbstractController
{

    //creation d'une fonction statique d'affichage
    static function print_q($val){
        echo "<pre style='background-color:#000;color:#3FBBD5;font-size:11px;z-index:99999;position:relative;'>";
        print_r($val);
        echo "</pre>";
    }

    // methode de creation du tableau de 10 nbres pairs et impairs
    static function pairsImpairs($nbre){
        $tab=[];
        $diviseur = 2;

        for($i= 0 ; $i< $nbre ; $i++){
            $choix = rand(1,100);

            if(fmod($choix,$diviseur) == 0){ // operation modulo afin de trouver le reste de la division
                  array_unshift($tab,$choix);  // si le nombre est pair , l'inserer a l avant'
            }else{
                $tab[] = $choix ;  // si le nbre est impair , l inserer a l arriere
            }
        }
        return $tab ;
    }

    // creation d'un tableau de string aleatoire

    static function stringTab($nbre){
        /* variable faker egal a l instanciation factory qui qui appele la methode static create */
       $faker = Factory::create();
       $tab = [];
       for($i = 0 ; $i < $nbre; $i++){
           $tab[] = $faker->word();
       }
      return $tab ;
   }



   /**
    * @Route("/article", name="app_article")
    */
    public function index(): Response
    {

        $tabPairs = self::pairsImpairs(10); // creation d un tableau de nbres pairs et impairs
        $tabString = self::stringTab(10); // creation d'un tableau de string

        $date = new DateTime("08-11-2023") ; // creation d'une date via la classe Datetime
        $date = $date->format('Y-m-j');  // mise en format annee-mois-jour

        /* self::print_q( self::stringTab(10)) ;
           self::print_q( self::pairsImpairs(10)) ;
           self::print_q( $date) ; */

        return $this->render('article/index.html.twig', [
            'titreBlog' => 'Mon Blog',
             'pairsImpairs'=> $tabPairs,
              'tabString'=>  $tabString,
             'date'=> $date

        ]);
    }
}
