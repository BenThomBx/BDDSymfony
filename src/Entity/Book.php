<?php

namespace App\Entity;


use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */

class Book

#EXO 1:
#- créez une table article dans votre BDD en utilisant une entité
#- dans cette table, vous devez avoir une colonne id (int, auto increment, clé primaire) et une colonne title
# (varchar 255)
#- servez vous de mon code sur github pour faire ça (sans copier coller) - résultat migrations/Version2021...150 vérifier
# s'il n'y a pas de migration en attente avec migrate.
#EXO 2:
# - créez trois nouvelles colonnes dans votre table book : author, publishedAt et nbPages (trouvez les bons types pour
# ces colonnes) Résultat: migrations/Version2021...125

{
    /**
     * mapping
     * création clé primaire
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $title;


    /**
     * @ORM\Column(type="integer")
     */
    private $nb_pages;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    //EXO bis:
    //- supprimez la relation entre les book et les auteurs (supprimez la propriété author dans l'entité book + les getters
    //  et setters)
            // /**
            //* @ORM\ManyToOne(targetEntity=Author::class)
            //*/
            //private $author;



    /**
     * @ORM\ManyToOne(targetEntity=Genre::class)
     */
    private $genre;


    //COMMENTAIRE : l'objectif est de créer une jonction entre les tables Book et Author par la propriété author.
    // La création de la propriété author via le Terminal permet de créer dans :
    //  *l'entité Book : l'ORM ci-dessous qui cible l'entité Author et crée le lien inversé de Author vers Book par les
    //   clés étrangères générée lors de la jonction entre les 2 tables. le ManytoOne permettant de relier plusieurs
    //   livres pour un auteur. getter et setter sont aussi créés par Symfony SUITE ->VOIR ENTITE AUTHOR



    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $author;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed $nb_pages
     */
    public function getNbPages(): ?int
    {
        return $this->nb_pages;
    }

    /**
     * @param mixed
     */
    public function setNbPages($nb_pages): void
    {
        $this->nb_pages = $nb_pages;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    //EXO :
    //- Dans l'entité Book, supprimez la propriété author (et le getter et setter associé)
    //- soit à la main, soit en ligne de commandes, créez une nouvelle propriété author qui sera un ManyToOne vers
    // l'entité (et donc la table) Author
    // COMMENTAIRE : créer un join entre tables
    // ATTENTION!  expliquer non pas ce que l'on fait mais ce qui se passe dans le programme
    // 1- supprimer la colonne author dans la classe Book afin de la remplacer par une clé étrangère issue de la table
    // Author. POur cela on enlève les getters et les setters d'author dans Book.php et on réalise la migration dans
    // le terminal.

    // 2- 2 méthodes pour créer le join soir manuellement dans phpstorm (avec migration dans le terminal) ou bien par
    // le formulaire du terminal par "create entity".

    // 3- dans le terminal : dans l'entité Book, on crée la propriété Author avec le type ManytoOne vers Author, et
    // on migre ces modifications.

            // public function getAuthor(): ?Author
            //{
            //return $this->author;
            //}
            //public function setAuthor(?Author $author): self
            //{
            //$this->author = $author;
            //return $this;
            //}
            public function getGenre(): ?Genre
            {
            return $this->genre;
            }
            public function setGenre(?Genre $genre): self
            {
            $this->genre = $genre;
            return $this;
            }
//EXO bis:
//- supprimez la relation entre les book et les auteurs (supprimez la propriété author dans l'entité book + les getters
//  et setters)
//- n'oubliez pas de faire votre migration + le migrate
//- recréez cette propriété en utilisant le terminal (make:entity) mais en précisant que vous voulez pouvoir aussi
//  récupérer les books depuis un auteur quand la question vous est posée.
//- afficher les books de chaque auteur dans twig

public function getAuthor(): ?Author
{
    return $this->author;
}

public function setAuthor(?Author $author): self
{
    $this->author = $author;

    return $this;
}


}

