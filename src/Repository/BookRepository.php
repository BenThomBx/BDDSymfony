<?php


namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


// EXO 13/12/21 10:14:
// Créez un moteur de recherche pour les livres avec :
// 2 - créez une méthode searchByTitle dans le repository de Book
// 3 - dans cette méthode, utilisez le queryBuilder pour construire votre requête SQL et récupérer les résultats
// COMMENTAIRE 13/12/21 Moteur de recherche
// Q2 & Q3: dans le BookRepository on crée la requête qui sera transcrite par doctrine pour SQL. On utilise la méthode
// queryBuilder de la classe ServiceEntityRepository pour construire la requête vers la BDD. On recherche ici les titres
// de livres qui contiennent l'élément demandé dans la requête. Et on retourne le résultat de la requête.


    public function searchByTitle($word)
    {
     $queryBuilder = $this->createQueryBuilder('b');

     $query = $queryBuilder->select('b')
         ->where('b.title LIKE :word')
         ->setParameter('word','%'.$word.'%')
         ->getQuery();

     return $query->getResult();
    }

}


