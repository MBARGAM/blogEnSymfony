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
            'msg' => "Veuillez découvrir vos articles"
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
     * @Route("/nombre", name="tableauNbre")
     */
    public function lesNbres(): Response
    {
        $tabPairs = self::pairsImpairs(10); // creation d un tableau de nbres pairs et impairs
        return $this->render('article/tabNbre.html.twig', [
            'nbre' => 'tableau de nbres',
            'pairsImpairs'=> $tabPairs
        ]);
    }

    // route et methode pour le tableau de string
    /**
     * @Route("/string", name="tableauString")
     */
    public function lesString(): Response
    {
        $tabString = self::stringTab(10); // creation d'un tableau de string

        return $this->render('article/tabString.html.twig', [
            'string' => 'tableau de string',
            'tabString'=>  $tabString
        ]);
    }

    // route et methode pour le maximum
    /**
     * @Route("/maximum", name="maximum")
     */
    public function maximum(): Response
    {
        $tabPairs = self::pairsImpairs(10); // creation d un tableau de nbres pairs et impairs

        return $this->render('article/maximum.html.twig', [
            'max' => 'chercher maximum',
            'pairsImpairs'=> $tabPairs
        ]);
    }

    // route et methode pour comparer les dates
    /**
     * @Route("/dates", name="compareDate")
     */
    public function ladate(): Response
    {
        $date = self::createDate() ; // creation d'une date via la classe Datetime

        return $this->render('article/dates.html.twig', [
            'ladate' => 'comparaisons',
            'date'=> $date
        ]);
    }




}
