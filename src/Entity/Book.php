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
     * @ORM\Column(type="string")
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_pages;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;


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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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


}

