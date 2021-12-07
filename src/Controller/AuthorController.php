<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
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
     * @Route ("/author/{id}", name="author")
     */

    public function author($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return $this->render("author.html.twig", ['author' => $author]);
    }
}