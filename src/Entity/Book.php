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

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
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
    // 1- supprimer la colonne author dans la classe Book afin de la remplacer par une clé étrangère issue de la table
    // Author. POur cela on enlève les getters et les setters d'author dans Book.php et on réalise la migration dans
    // le terminal.
    // 2- 2 méthodes pour créer le join soir manuellement dans phpstorm (avec migration dans le terminal) ou bien par
    // le formulaire du terminal par "create entity".
    // 3- dans le terminal : dans l'entité Book, on crée la propriété Author avec le type ManytoOne vers Author, et
    // on migre ces modifications.

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

