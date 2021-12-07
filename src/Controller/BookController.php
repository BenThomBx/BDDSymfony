<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BookController extends AbstractController

{



        //
        //EXO :
        //Dans une nouvelle page, créer une instance de la classe Book, insérez des valeurs pour le titre, auteur etc et
        // faites un var_dump sur ce que vous obtenez - Faites pareil pour les auteurs - COMMENTEZ VOTRE CODE
        //
        //COMMENTAIRE :
        //
        // EXO :dans vos pages qui créent des livres et des auteurs, utilisez l'EntityManager pour enregistrer votre livre
        //et votre auteur au chargement de la page.
        //COMMENTAIRE :
         //Je crée une instance de la classe Book (de l'entité Article ...euh oui, superposition d'exercices). Et transfère
         //ainsi via Doctrine une nouvelle ligne de données (ou nouvel enregistrement) dans la BDD.
         //en insérant la classe EntityManager dans les paramètres de la méthode createBook, Symfony instancie cette
         //classe automatiquement par le système d'autowire.
         //

    /**
     * @Route("/book/create", name="book_create")
     */
    public function createBook(EntityManagerInterface $entityManager)
    {

        $book = new Book();
        $book->setTitle( "Les thanatonautes" );
        $book->setAuthor("Bernard Werber");
        $book->setNbPages("700");
        $book->setPublishedAt(new \DateTime('1995-12-12'));

        $entityManager->persist($book);
        $entityManager->flush();

        /** COMMENTAIRE l'enregistrement dans la BDD se fera en plusieurs étapes: persist permet de collecter les
         * nouvelles données et flush de les envoyer vers la BDD.
         */

       /**
        * dump($book);die;
        */

        return $this->render('book_create.html.twig');

    }

    //EXO :
    //créez les pages pages pour mettre à jour un livre et un auteur
    //COMMENTAIRE :
     //1- Etablir la route vers la mise à jour : update, celle-ci contient une wildcard pour accéder aux différentes
     //valeurs d'id de la base de données et ainsi sélectionner le livre-cible.
     //2 - Accéder au champs du livre qui doit être mis à jour dans la BDD book: on utilise la classe BookRepository,
    // et la fonction find.
    // 3 - Par la fonction setTitle on apporte la nouvelle valeur du champs.
     //4 - Valider la mise à jour du (ou des champs) du livre choisi par le service/classe EntityManager : 2 étapes se
    // succèdent pour capter (persist) et transmettre (flush) les variables à la BDD via Doctrine.
     //


    /**
     * @Route("/book/update/{id}", name="book_update")
     */


    public function updateBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {

        $book = $bookRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null"//
        $book->setTitle( "Les nouveaux thanataunotes" );


        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('book_update.html.twig');
    }


    /**
     * @Route ("/book/{id}", name="book")
     */
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("book.html.twig", ['book' => $book]);
    }

}