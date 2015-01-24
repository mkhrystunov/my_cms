<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        $books = new Category();
        $books->setName('Books');

        $clothes = new Category();
        $clothes->setName('Clothes');

        $em->persist($books);
        $em->persist($clothes);
        $em->flush();

        $this->addReference('category-books', $books);
        $this->addReference('category-clothes', $clothes);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
