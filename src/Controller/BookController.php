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

    /**
     * @Route("/book/create", name="book_create")
     */
    public function createBook(EntityManagerInterface $entityManager)
    {

        $book = new Book();
        $book->setTitle( "Win" );
        $book->setAuthor("Harlan Coben");
        $book->setNbPages("375 ");
        $book->setPublishedAt(new \DateTime('NOW'));

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
        //
        //COMMENTAIRE :
        //1- Etablir la route vers la mise à jour : update, celle-ci contient une wildcard pour accéder aux différentes
        //valeurs d'id de la base de données et ainsi sélectionner le livre-cible.
        //2 - Accéder au champs du livre qui doit être mis à jour dans la BDD book: on utilise la classe BookRepository,
        // et la fonction find.
        // 3 - Par la fonction setTitle on apporte la nouvelle valeur du champs.
        //4 - Valider la mise à jour du (ou des champs) du livre choisi par le service/classe EntityManager : 2 étapes
        // se succèdent pour capter (méthode persist de la classe EntityManager) et transmettre les variables à la BDD
        // via Doctrine(méthode flush de la classe EntityManager) .


    /**
     * @Route("/book/update/{id}", name="book_update")
     */

    // EntityManagerInterface instancie la variable $entityManager par l'autowire idem BookRepository:
    public function updateBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {

        $book = $bookRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//
        $book->setTitle( "Les nouveaux thanataunotes" );


        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('book_update.html.twig');
    }


    /**
     * @Route("/book/remove/{id}", name="book_remove")
     */

    // EntityManagerInterface instancie la variable $entityManager par l'autowire idem BookRepository:

    // COMMENTAIRE : pour effacer une entrée de la BDD (1 id et toutes les propriétés correspondantes) on crée une
    // méthode, que j'appelle removeBook.
    // 1- Pour isoler la fiche livre ciblée on l'identifie par son id grâce une
    // wildcard dans l'url : la route indique ainsi le chemin vers la méthode remove de la BDD author avec une id.
    // 2- la méthode removeBook contient les paramètres suivants : $id (de l'url), la classe BookRepository qui
    // instancie la variable $bookRepository par autowire qui donne accès aux données de la BDD, de même pour la
    // classe EntityManagerInterface qui permettra de renvoyer la modification vers la BDD via Doctrine.
    // 3- la variable author vaut alors les valeurs de $id dans la classe BookRepository grâce à la méthode find.
    // 4- la classe EntityManger permet alors d'effacer $author pour $id par la méthode remove et valide la modification
    // par la méthode flush.
    // 5- on retourne dans le navigateur une page qui confirme l'action (effacer) pour l'utilisateur.

    public function removeBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {

        $book = $bookRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->render('book_remove.html.twig');
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