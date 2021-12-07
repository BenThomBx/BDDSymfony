<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BookController extends AbstractController

{



    /**
     * EXO :
     * Dans une nouvelle page, créer une instance de la classe Book, insérez des valeurs pour le titre, auteur etc et
     * faites un var_dump sur ce que vous obtenez - Faites pareil pour les auteurs - COMMENTEZ VOTRE CODE
     *
     * COMMENTAIRE :
     *
     * EXO :dans vos pages qui créent des livres et des auteurs, utilisez l'EntityManager pour enregistrer votre livre
     * et votre auteur au chargement de la page.
     * COMMENTAIRE :
     *  Je crée une instance de la classe Book (de l'entité Article ...euh oui, superposition d'exercices). Et transfère
     * ainsi via Doctrine une nouvelle ligne de données (ou nouvel enregistrement) dans la BDD.
     * en insérant la classe EntityManager dans les paramètres de la méthode createBook, Symfony instancie cette
     * classe automatiquement par le système d'autowire.
     */

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

    /**
     * @Route ("/book/{id}", name="book")
     */
    public function book($id, BookRepository $articleRepository)
    {
        $book = $articleRepository->find($id);

        return $this->render("book.html.twig", ['book' => $book]);
    }

}