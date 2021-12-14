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

class ProfileAuthorController extends AbstractController
{
    /**
     * @Route("/profile/authors", name="profile_authors")
     */
    public function authors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();
        return $this->render('profile/authors.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * @Route ("/profile/author/{id}", name="profile_author")
     */

    public function author($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return $this->render("profile/author.html.twig", ['author' => $author]);
    }
}