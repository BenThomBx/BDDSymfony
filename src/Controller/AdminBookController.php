<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminBookController extends AbstractController

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



        // /**
        //* @Route("admin/book/create", name="admin_book_create")
        //*/

        //public function createBook(EntityManagerInterface $entityManager)
        //{

        //$book = new Book();
        //$book->setTitle( "Win" );
        //$book->setAuthor("Harlan Coben");
        //$book->setNbPages("375 ");
        //$book->setPublishedAt(new \DateTime('NOW'));

        //$entityManager->persist($book);
        //$entityManager->flush();

        /** COMMENTAIRE l'enregistrement dans la BDD se fera en plusieurs étapes: persist permet de collecter les
         * nouvelles données et flush de les envoyer vers la BDD.
         */

       /**
        * dump($book);die;
        */
        //return $this->render('admin/book_create.html.twig');
    //}

// EXO :09/12/21 11:50
//- En utilisant la ligne de commande "php bin/console make:form", créez un gabarit de formulaire pour l'entité Book:
// Terminal :
//5b90734..297b8f5  master -> master
//┌─(/Applications/MAMP/htdocs/u6constructor)────────────────────────────────(benedicte@MacBook-Air-de-Benedicte:s000)─┐
//└─(10:12:54 on master)──> php bin/console make:form                                                    ──(Jeu,déc09)─┘

//The name of the form class (e.g. DeliciousPopsicleType):
//> BookType

//The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
//> Book

//created: src/Form/BookType.php

//Success!

//- Dans votre contrôleur de création de book, supprimez le code existant et récupérez votre gabarit de formulaire avec
// la méthode $this-createForm(). Cette méthode prend en premier paramètre la classe du gabarit de formulaire et en
// second parametre une instance de l'entité Book
//- Envoyez la vue de ce formulaire à votre fichier twig et affichez le dans votre twig avec la fonction form
// Attention, vu qu'on a déplacé la route d'affichage d'un article par son id et qu'elle rentre en conflit avec le create,
// déplacez la route du create au dessus de celle de l'affichage d'un article, ou alors utilisez les requirements de la
// route.
//- COMMENTEZ : dans la méthode createBook on instancie la variable $book (nécessaire ici car Book est une entity)
// on appelle la méthode form de l'abstract contrôleur et on lui passe les paramètres suivants : le nom de la classe
// du formulaire et l'instance attendue de $book.

// EXO 09/12/21 14:00
// Utilisez votre formulaire pour enregistrer les données de l'utilisateur dans la table book
    // COMMENTAIRE : a) pour récupérer selon la méthode POST les données saisies dans le formulaire par l'utilisateur
    // utiliser la classe Request en paramètre de la méthode createBook et instancier par autowire la variable
    // $request. b) les données saisies sont associées aux colonnes de la BDD du gabarit de formulaire par la
    // méthode handleRequest. c) vérification de la qualité des données : pour vérifier qu'elles ne sont pas nulles on
    // utilise la méthode isSubmitted (* voir BookType) et pour vérifier qu'elles sont conformes aux valeurs attendues on utilise la
    // méthode isValid (intégrité et sécurité). d) Dans createBook on ajoute l'EntityManagerInterface pour collecter
    // (persist) et envoyer (flush)les nouvelles valeurs de $book vers la BDD par l'entité Book.


    /**
     * @Route("admin/book/create", name="admin_book_create")
     */
    public function createBook(Request $request, EntityManagerInterface $entityManager)
    {
        $book = new Book();
        $bookForm = $this->createForm(BookType::class, $book);
        $bookForm->handleRequest($request);

        if ($bookForm->isSubmitted() && $bookForm->isValid())
            {
                $entityManager->persist($book);
                $entityManager->flush();
            }

        return $this->render("admin/book_create.html.twig",[
        'bookForm'=> $bookForm->createView()]);

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
     * @Route("admin/book/update/{id}", name="admin_book_update")
     */

        // EntityManagerInterface instancie la variable $entityManager par l'autowire idem BookRepository:
        //public function updateBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
        //{

        //   $book = $bookRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//
        // $book->setTitle( "Les nouveaux thanataunotes" );


        //  $entityManager->persist($book);
        //  $entityManager->flush();

        //:  return $this->render('admin/book_update.html.twig');
        // }

    //EXO 09/12/21 15:45
    //-a) Dans le controleur qui met à jour un livre, utilisez un formulaire pour faire la mise à jour. Le code sera le
    // même que pour la création, sauf pour la création de la variable $book
    //- b)faire un lien dans la liste des livres pour mettre à jour le livre
    //- c) dans la même page ajouter un lien pour créer un livre

    // COMMENTAIRE : 09/12/21 15:47
    // a) même démarche que pour la création mais au lieu d'instancier une nouvelle valeur (un nouvel objet?)de $book on va
    // chercher grâce à la classe BookRepository et une wildcard les données présentes en bases de données pour la valeur
    // courante de l'id.
    // b) & c) voir books.html.twig (templates/admin/books.html.twig)


    public function updateBook($id, Request $request, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        $book = $bookRepository->find($id);
        $bookForm = $this->createForm(BookType::class, $book);
        $bookForm->handleRequest($request);

        if ($bookForm->isSubmitted() && $bookForm->isValid())
        {
            $entityManager->persist($book);
            $entityManager->flush();
        }

        return $this->render("admin/book_update.html.twig",[
            'bookForm'=> $bookForm->createView()]);
    }




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



//EXO 9.12.21 9/30:
//- Dans la liste des livres, ajoutez un lien vers la route de suppression d'un livre (qui existe déjà)
//- Dans le controleur qui gère la suppression, au lieu de retourner un twig qui valide la suppression, faites une
// redirection vers la liste des livres

//COMMENTAIRE : 1- dans le fichier books.html.twig, j'ajoute le lien <a class="link" href="{{ path('book_remove',
// {"id": book.id}) }}">Supprimer le livre</a> à tous les livres permettant de supprimer chaque livre en
// utilisant la wildcard du livre concerné , grâce à la methode remove-book du BookController.
// 2 - ci-dessous on retourne une redirection vers la liste des livres.


    /**
     * @Route("admin/book/remove/{id}", name="admin_book_remove")
     */

    public function removeBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {

        $book = $bookRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('admin_books');

    }

    /**
     * @Route ("admin/book/{id}", name="admin_book")
     */
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("admin/book.html.twig", ['book' => $book]);
    }

    //09.12.21 10:10
    // on ajoute admin devant toutes les routes pour séparer les accès admin des accès front.

}