<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\AuthorType;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileBookController extends AbstractController
{
    /**
     * @Route ("/profile/book/{id}", name="profile_book")
     */
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("profile/book.html.twig", ['book' => $book]);
    }

    /**
     * @Route("/profile/book_search", name="profile_book_search")
     */

    public function bookSearch (BookRepository $bookRepository, Request $request)


    {
        $word = $request->query->get('q');

        $books = $bookRepository->searchByTitle($word);

        return $this->render('profile/book_search.html.twig', ['books' => $books]);

    }
}

