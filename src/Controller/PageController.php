<?php

namespace App\Controller;

    use App\Repository\AuthorRepository;
    use App\Repository\BookRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */

    public function home()
    {
        $books = [];
        return $this->render("home.html.twig", ['home' => $books]);
    }

    /**
     * @Route ("/books", name="books")
     */
    // pour instancier la classe BookRepository
    // j'utilise l'autowire de Symfony
    // et je passe en parametres de la méthode de controleur
    // le nom de la classe "BookRepository" et une variables
    // dans laquelle je veux que symfony m'instancie la classe
    public function books(BookRepository $articleRepository)
    {
        // j'utilise la méthode findAll de la classe BookRepository
        // pour récupérer tous les livres de la table book
        $books = $articleRepository->findAll();

        return $this->render("books.html.twig", ['books' => $books]);
    }

    /**
     * @Route ("/authors", name="authors")
     */
    // pour instancier la classe BookRepository
    // j'utilise l'autowire de Symfony
    // et je passe en parametres de la méthode de controleur
    // le nom de la classe "BookRepository" et une variables
    // dans laquelle je veux que symfony m'instancie la classe
    public function authors(AuthorRepository  $authorRepository)
    {
        // j'utilise la méthode findAll de la classe BookRepository
        // pour récupérer tous les livres de la table book
        $authors = $authorRepository->findAll();

        return $this->render("authors.html.twig", ['authors' => $authors]);
    }

}

