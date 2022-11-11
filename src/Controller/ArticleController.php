<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    // creation d'une date aleatoire via une fonction statique '

    static function createDate(){
        /* variable faker egal a l instanciation factory qui qui appele la methode static create */
        $faker = Factory::create();
        $date =  new DateTime( $faker->date());
        $date = $date->format('d-m-Y');  // mise en format jour-mois-annee
        return  $date ;
    }



   /**
    * @Route("/article", name="article")
    */
    public function article(): Response
    {
        /* self::print_q( self::stringTab(10)) ;
           self::print_q( self::pairsImpairs(10)) ;
           self::print_q( $date) ; */

        return $this->render('article/article.html.twig', [
            'titreArticle' => 'Article',
            'msg' => "Veuillez visiter vos articles"
        ]);
    }

    // route et methode pour la page d accueil
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        $msg = "Bienvenue sur votre page d'accueil";

        return $this->render('article/index.html.twig', [
            'accueil' => 'mon blog',
            'msg'=> $msg
        ]);
    }


    // route et fonction pour le tableau de nbre
    /**
     * @Route("/article/{article}", name="nosArticles")
     */
    public function nosArticles($article): Response
    {
        switch ($article){

            case "tabNbre" :
                    $tabPairs = self::pairsImpairs(10); // creation d un tableau de nbres pairs et impairs
                    $view = 'article/tabNbre.html.twig';
                    $param = [
                        'nbre' => 'tableau de nbres',
                        'pairsImpairs'=> $tabPairs
                    ];
                break;
            case "tabString" :
                    $tabString = self::stringTab(10); // creation d'un tableau de string
                     $view = 'article/tabString.html.twig';
                     $param = [
                         'string' => 'tableau de string',
                         'tabString'=>  $tabString
                     ];
                break;
            case "maximum" :
                    $tabPairs = self::pairsImpairs(10); // creation d un tableau de nbres pairs et impairs
                    $view = 'article/maximum.html.twig';
                    $param = [
                        'max' => 'chercher maximum',
                        'pairsImpairs'=> $tabPairs
                    ];
                break;
            case "compare" :
                    $date = self::createDate() ; // creation d'une date via la classe Datetime
                    $view = 'article/dates.html.twig';
                    $param = [
                        'ladate' => 'comparaisons',
                        'date'=> $date
                    ];
                break;
        }

        return $this->render( $view,$param );
    }

    
    // route et methode pour recuperer le vote fait en ajax
    /**
     * @Route("/vote/{somme}", name="vote")
     */
    public function vote($somme): JsonResponse
    {
        $nbreActuel = intval($somme);

         if(is_numeric($nbreActuel)){
             $nbreActuel = $nbreActuel + 1 ;
         }

        return $this->json(['ajout' => $nbreActuel]);
    }






}
