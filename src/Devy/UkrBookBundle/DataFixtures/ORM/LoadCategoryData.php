<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCategoryData
 * @package Devy\UkrBookBundle\DataFixtures\ORM
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $books1 = new Category();
        $books1->setTitle('Books #1')
            ->setIsActive(true);

        $books2 = new Category();
        $books2->setTitle('Books #2')
            ->setIsActive(true);

        $subBooks1 = new Category();
        $subBooks1->setTitle('SubBooks #1')
            ->setParent($books1)
            ->setIsActive(true);

        $manager->persist($books1);
        $manager->persist($books2);
        $manager->persist($subBooks1);
        $manager->flush();

        $this->addReference('category1', $books1);
        $this->addReference('category2', $books2);
        $this->addReference('subCategory1', $subBooks1);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
