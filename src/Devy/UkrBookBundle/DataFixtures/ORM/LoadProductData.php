<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Product;
use Devy\UkrBookBundle\Entity\ProductAttribute;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadProductData
 * @package Devy\UkrBookBundle\DataFixtures\ORM
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category1 = $manager->merge($this->getReference('category1'));
        $category2 = $manager->merge($this->getReference('category2'));
        $subCategory1 = $manager->merge($this->getReference('subCategory1'));
        $attribute1 = $manager->merge($this->getReference('attribute1'));
        $attribute2 = $manager->merge($this->getReference('attribute2'));
        $brand1 = $manager->merge($this->getReference('brand1'));
        $brand2 = $manager->merge($this->getReference('brand2'));

        $productAttribute1 = new ProductAttribute();
        $productAttribute1
            ->setAttribute($attribute1)
            ->setValue('200');
        $productAttribute2 = new ProductAttribute();
        $productAttribute2
            ->setAttribute($attribute2)
            ->setValue('Some Author');
        $manager->persist($productAttribute1);
        $manager->persist($productAttribute2);

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product
                ->setTitle('Book #' . $i)
                ->setBrand($i % 2 === 0 ? $brand1 : $brand2)
                ->setCategory($category1)
                ->setDescription('Just some dummy description.')
                ->setPageTitle('Book #' . $i)
                ->setPrice(($i + 1) * 36.40)
                ->setIsActive(true)
                ->addProductAttribute($productAttribute1);

            $manager->persist($product);
        }
        for ($i = 10; $i < 20; $i++) {
            $product = new Product();
            $product
                ->setTitle('Book #' . $i)
                ->setBrand($i % 2 === 0 ? $brand1 : $brand2)
                ->setCategory($category2)
                ->setDescription('Just some dummy description.')
                ->setPageTitle('Book #' . $i)
                ->setPrice(($i + 1) * 36.40)
                ->setIsActive(true)
                ->addProductAttribute($productAttribute1)
                ->addProductAttribute($productAttribute2);

            $manager->persist($product);
        }
        for ($i = 20; $i < 30; $i++) {
            $product = new Product();
            $product
                ->setTitle('Book #' . $i)
                ->setBrand($i % 2 === 0 ? $brand1 : $brand2)
                ->setCategory($subCategory1)
                ->setDescription('Just some dummy description.')
                ->setPageTitle('Book #' . $i)
                ->setPrice(($i + 1) * 36.40)
                ->setIsActive(true)
                ->addProductAttribute($productAttribute1);

            $manager->persist($product);
        }
        $product1 = new Product();
        $product1
            ->setTitle('Book #' . 31)
            ->setBrand($brand1)
            ->setCategory($category2)
            ->setDescription('Just some dummy description.')
            ->setPageTitle('Book #' . $i)
            ->setPrice(99.99)
            ->setIsActive(true)
            ->addProductAttribute($productAttribute1)
            ->addProductAttribute($productAttribute2);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
