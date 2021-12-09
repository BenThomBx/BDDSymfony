<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EXO :
- Créez, grâce à la ligne de commandes (php bin/console make:entity) une nouvelle table "author" avec trois colonnes :
 * id, firstName, lastName, deathDate
 * COMMENTAIRE :
 * soit    php bin/console make:entity                       pour créer le fichier d’entité en .php dans src/entity
 * puis    php bin/console make:migration                    pour créer les fichiers Version… dans le dossier migrations
 * et      php bin/console doctrine:migration:migrate        pour créer le lien vers MySQL visible dans phpmyadmin.
 */


/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fisrtName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deathDate;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author")
     */
    private $books;

    // COMMENTAIRE
    //  *l'entité Author : l'ORM OnetoMany ci-dessus cible l'entité Book et signifie la correspondance entre les deu
    //   tables, permettant à un auteur d'aller chercher des livres dans book. getters et setters sont aussi créés
    //   par Symfony.
    // Ci-dessous la méthode construct créée par Symfony, permet d'intégrer les différents livres qui peuvent être
    // reliés à un auteur. Sous forme de tableau les données peuvent être accessibles (CRUD) indépendemment les
    // unes des autres.

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFisrtName(): ?string
    {
        return $this->fisrtName;
    }

    public function setFisrtName(string $fisrtName): self
    {
        $this->fisrtName = $fisrtName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathDate(?\DateTimeInterface $deathDate): self
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
