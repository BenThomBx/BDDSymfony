<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
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
     * @Route("/author/create", name="author_create")
     */
    public function createAuthor(EntityManagerInterface $entityManager)
    {
        $author = new Author();
        $author->setFisrtName("Bernard");
        $author->setLastName("WERBER");

        //dump($author); die;

        $entityManager->persist($author);
        $entityManager->flush();

        /** l'enregistrement dans la BDD se fera en plusieurs étapes: persist permet de collecter les nouvelles
         * données et flush de les envoyer vers la BDD.
         */
        return $this->render('author_create.html.twig');

    }
    /**
     * @Route("/author/update/{id}", name="author_update")
     */

    public function updateAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        $author= $authorRepository->find($id);
        $author->setDeathDate("07122021");

        $entityManager->persist($id);
        $entityManager->flush();

        $this->render(author_update.html.twig);
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
     * @Route("/author/remove/{id}", "name=remove_author")
     */

    public function removeAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {

        $author = $authorRepository->find($id);
        // de nouveau des problèmes d'accès à setTitle "Call to a member function setTitle() on null" résolu la BDD
        //n'avait plus qu'une seule ligne à ce moment-là//

        $entityManager->remove($author);
        $entityManager->flush();

        return $this->render('author_remove.html.twig');
    }



    /**
     * @Route ("/author/{id}", name="author")
     */

    public function author($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return $this->render("author.html.twig", ['author' => $author]);
    }
}