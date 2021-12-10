<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAuthorController extends AbstractController
{

    /**
    * EXO :dans vos pages qui créées des livres et des auteurs, utilisez l'EntityManager pour enregistrer votre livre et
    * votre auteur au chargement de la page.
     * COMMENTAIRE :
     *  Je crée une instance de la classe Author (de l'entité Author). Pour transférer via doctrine une nouvelle
     * ligne de données (ou nouvel enregistrements dans la BDD)
     * en insérant la class EntityManager dans les paramètres de la méthode createAuthor, Symfony instancie cette
     * classe automatiquement par le système d'autowire).
    */



    /**
     * @Route("/admin/author/create", name="admin_author_create")
     */
    public function createAuthor(Request $request, EntityManagerInterface $entityManager)
    {
        $author = new Author();
        $authorForm = $this->createForm(AuthorType::class,$author);
        $authorForm->handleRequest($request);

        if ($authorForm->isSubmitted() && $authorForm->isValid())
        {


            //dump($author); die;

            $entityManager->persist($author);
            $entityManager->flush();

            /** l'enregistrement dans la BDD se fera en plusieurs étapes: persist permet de collecter les nouvelles
             * données et flush de les envoyer vers la BDD.
             */
            return $this->render('admin/author_create.html.twig',['authorForm' => $authorForm->createView()]);

       }

    }


    /**
     * @Route("/admin/author/update/{id}", name="admin_author_update")
     */

    public function updateAuthor($id, Request $request, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        $author = $authorRepository->find($id);
        $authorForm = $this->createForm(AuthorType::class, $author);
        $authorForm->handleRequest($request);

        if ($authorForm->isSubmitted() && $authorForm->isValid()) {

            $entityManager->persist($author);
            $entityManager->flush();
        }
            return $this->render("admin/author_update.html.twig", ['authorForm' => $authorForm->createView()]);


    }

    // COMMENTAIRE : pour effacer une entrée de la BDD (1 id et toutes les propriétés correspondantes) on crée une
    // méthode, que j'appelle removeAuthor.
    // 1- Pour isoler la fiche auteur ciblée on l'identifie par son id grâce une
    // wildcard dans l'url : la route indique ainsi le chemin vers la méthode remove de la BDD author avec une id
    // et on identifie XXXX par name.
    // 2- la méthode removeAuthor contient les paramètres suivants : $id (de l'url), la classe AuthorRepository qui
    // instancie la variable $authorRepository par autowire qui donne accès aux données de la BDD, de même pour la
    // classe EntityManagerInterface qui permettra de renvoyer la modification vers la BDD via Doctrine.
    // 3- la variable author vaut alors les valeurs de $id dans la classe AuthorRepository grâce à la méthode find.
    // 4- la classe EntityManger permet alors d'effacer $author pour $id par la méthode remove et valide la modification
    // par la méthode flush.
    // 5- on retourne dans le navigateur une page qui confirme l'action (effacer) pour l'utilisateur.
    /**
     * @Route("/admin/author/remove/{id}", name="admin_author_remove")
     */

    public function removeAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {

        $author = $authorRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//

        $entityManager->remove($author);
        $entityManager->flush();

        return $this->redirectToRoute('admin_authors');

    }



    /**
     * @Route ("/admin/author/{id}", name="admin_author")
     */

    public function author($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return $this->render("admin/author.html.twig", ['author' => $author]);
    }
}