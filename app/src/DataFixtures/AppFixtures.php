<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Equipement;
use App\Entity\TypeDeBien;
use App\Entity\CategorieEquipement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder; //def d'une propriété privé ou l'on instanciera l'interface d'encodage du mdp

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->encoder = $hasher; //injection de l'interface dans la propriete 
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->loadCategorieEquipement($manager);
        $this->loadEquipement($manager);
        $this->loadTypeDeBien($manager);

        $manager->flush();
    }

    //Création categorie equipement
    public function loadCategorieEquipement(ObjectManager $manager)
    {
        $equipementCatArray = ["salle de bain","cusine","chambre","exterieur","les petits plus"];
        // dump($equipementCatArray);

        foreach($equipementCatArray as $ec => $value){
            $equipementCat = new CategorieEquipement();
            $equipementCat->setLabel($value);
            
            $manager->persist($equipementCat);
            $this->addReference('equipementcat-'. $ec+1 , $equipementCat);

        }

    }

    //creation equipement
    public function loadEquipement(ObjectManager $manager)
    {

        //tableau associatif
        $array = [
            ['label' => 'Wi-Fi', 'equipementCat' => 5],
            ['label' => 'Télévision', 'equipementCat' => 5],
            ['label' => 'Climatisation', 'equipementCat' => 5],
            ['label' => 'Chauffage', 'equipementCat' => 5],
            ['label' => 'Cuisine équipée', 'equipementCat' => 2],
            ['label' => 'Salle de bain privée', 'equipementCat' => 1],
            ['label' => 'Salle de bain commune', 'equipementCat' => 1],
            ['label' => 'Machine à laver', 'equipementCat' => 1],
            ['label' => 'Sèche-cheveux', 'equipementCat' => 1],
            ['label' => 'Fer à repasser', 'equipementCat' => 5],
            ['label' => 'Parking gratuit', 'equipementCat' => 4],
            ['label' => 'Animaux autorisés', 'equipementCat' => 5],
            ['label' => 'Non-fumeur', 'equipementCat' => 5],
            ['label' => 'Balcon ou terrasse', 'equipementCat' => 4],
            ['label' => 'Piscine', 'equipementCat' => 5],
            ['label' => 'Jacuzzi', 'equipementCat' => 5],
            ['label' => 'Lit king-size', 'equipementCat' => 3],
            ['label' => 'Lit queen-size', 'equipementCat' => 3],
            ['label' => 'Lit double', 'equipementCat' => 3],
            ['label' => 'Lit simple', 'equipementCat' => 3],
            ['label' => 'Lit bébé', 'equipementCat' => 3],
            ['label' => 'Canapé-lit', 'equipementCat' => 3],
            ['label' => 'Espace de travail', 'equipementCat' => 5],
            ['label' => 'Cafetière', 'equipementCat' => 2],
            ['label' => 'Bouilloire', 'equipementCat' => 2],
            ['label' => 'Micro-ondes', 'equipementCat' => 2],
            ['label' => 'Réfrigérateur', 'equipementCat' => 2],
            ['label' => 'Lave-vaisselle', 'equipementCat' => 2],
            ['label' => 'Ustensiles de cuisine', 'equipementCat' => 2],
            ['label' => 'Vaisselle et couverts', 'equipementCat' => 2],
            ['label' => 'Linge de lit', 'equipementCat' => 3],
            ['label' => 'Serviettes', 'equipementCat' => 1],
            ['label' => 'Shampooing', 'equipementCat' => 1],
            ['label' => 'Gel douche', 'equipementCat' => 1],
            ['label' => 'Kit de premiers secours', 'equipementCat' => 5]     
        ];

        foreach ($array as $key => $catequip){
            $equipement = new Equipement();
            $equipement->setLabel($catequip["label"]);
            $equipement->setImagepath('toto');
            $equipement->setCategorieEquipement($this->getReference('equipementcat-'. $catequip['equipementCat']));
            $manager->persist($equipement);
            $this->addReference('equipement-'. $key+1, $equipement);

        }

    }

    //Création type de bien 
    public function loadTypeDeBien(ObjectManager $manager)
    {
        $typeBienArray = [
            ['key' => 1, 'label' => 'Maison' ,'imagePath' => 'house.svg'],
            ['key' => 2, 'label' => 'appartment', 'imagePath' => 'appartement.jpg'],
            ['key' => 3, 'label' => 'cabane', 'imagePath' => 'cabanes.jpg'],
            ['key' => 4, 'label' => 'lieuinsolite', 'imagePath' => 'lieuinsolite.jpg'],
            ['key' => 5, 'label' => 'avecvu', 'imagePath' => 'avecvu.jpg'],
        ];

         foreach($typeBienArray as $key => $value){
             $typeDeBien = new TypeDeBien();
             $typeDeBien->setLabel($value['label'])
                     ->setImagepath($value['imagePath']);
            $manager->persist($typeDeBien);

 
         }

    }

}
