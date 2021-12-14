<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilePageController extends AbstractController
{
    /**
     * @Route("/profile", name="profile_home")
     */
    public function dashboard(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {
        $lastBooks = $bookRepository->findBy([], ['id' => 'DESC'], 3);
        $lastAuthors = $authorRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render("profile/dashboard.html.twig", [
            'lastBooks' => $lastBooks,
            'lastAuthors' => $lastAuthors
        ]);
    }

    /**
     * @Route ("/", name="profile_dashboard")
     */

    public function home()
    {
        $books = [];
        return $this->render("profile/dashboard.html.twig", ['home' => $books]);
    }

    /**
     * @Route ("profile/books", name="profile_books")
     */

    public function books(BookRepository $bookRepository)
    {

        $books = $bookRepository->findAll();

        return $this->render("profile/books.html.twig", ['books' => $books]);
    }

    /**
     * @Route ("/authors", name="profile_authors")
     */

    public function authors(AuthorRepository $authorRepository)
    {

        $authors = $authorRepository->findAll();

        return $this->render("profile/authors.html.twig", ['authors' => $authors]);

    }




}





