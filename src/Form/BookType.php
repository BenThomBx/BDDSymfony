<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    //EXO 10.12.2021 13:40
    //- Dans le formulaire du livre, ajoutez la selection de l'auteur grâce au BookType
    //COMMENTAIRE 10.12.2021 14:00 : la table Author est reliée à la table Book par une clé étrangère et
    // on souhaite créer un formulaire permettant de compléter à la fois les deux tables. Dans le formulaire
    // du BookType créé précedemment on ajoute la colonne author et comme elle est reliée à plusieurs collonnes
    // dans Author, on lui donne les paramètres suivants :
    // - un type Entity qui permet d'accéder aux différentes colonnes de la table Author,
    // - avec l'option choice_label on retourne les colonnes qui seront utilisées dans le formulaire grâce à la méthode
    //   get+le nom du champs. Entre 2 point on crée un espace pour séparer les données des différentes colonnes.
    //



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nb_pages')
            ->add('publishedAt')
            ->add('author', EntityType::class, ['class' =>Author::class, 'choice_label' => function($author)
                {
                    return $author->getFisrtName() . ' ' . $author->getLastName();
                }
             ])
            ->add('valider', SubmitType::class);
            //pour le bouton submit "valider" ne figurant pas dans la BDD il convient de préciser son type.
           // ->add('genre')


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
