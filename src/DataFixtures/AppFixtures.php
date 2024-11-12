<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Products;
use App\Entity\SubCategories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //créer 3 catégorie
        $categoryNames = ['Pipes en bois de boulogne', 'Pipes en PVC', 'Pipes Souple', 'Pipe longue'];

        for ($i = 0; $i < 4; $i++) {
            $category = new Categories();
            $category->setName($categoryNames[$i]);
            $category->setDescription('Les meilleurs pipes sur le marché');
            $category->setCover('https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcRi1pjEaRPo-nouleuZByxizOcYtwBxRbnvovBYvAV3gJsMKl1t7-nP497MJJFMUzQRwWGkiblk_OEGanB2gCuOUe9PhV9OYWP8KehwfYdGV3Vi5AMHNpXh');
            $manager->persist($category);
            $categories[] = $category;
        }

        //créer 4 sous catégorie
        $subcategoryName = ['Premium', 'Collection Noël', 'Baveuse', 'A bulle', 'La turluteuse'];

        for ($i =0; $i < 5; $i++) {
            $subcategory = new SubCategories();
            $subcategory->setName($subcategoryName[$i]);
            $subcategory->setDescription('Nouvelles tendances');
            $subcategory->setParent($category);
            $manager->persist($subcategory);
            $subcategories[] = $subcategory;
        }

        //créer 20 produits
        for ($i = 0; $i < 20; $i++) {
            $product = new Products();
            $product->setName('pipe n°'.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Une nouvelle pipe originale en bois de boulogne');
            $product->setCover('https://media.istockphoto.com/id/498810251/fr/photo/tabac-%C3%A0-pipe-isol%C3%A9-sur-blanc.jpg?s=612x612&w=0&k=20&c=xiojRbgYD02A5nS-XVuCvHj4x5YOYCrteZ4Sc53C-Cw=');
            $product->setPrice('15€');
            $product->setCategory($subcategory);
            $manager->persist($product);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
