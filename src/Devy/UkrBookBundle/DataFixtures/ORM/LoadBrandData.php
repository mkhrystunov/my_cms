<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Brand;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadBrandData
 * @package Devy\UkrBookBundle\DataFixtures\ORM
 */
class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $brand1 = new Brand();
        $brand1->setName('Brand #1')
            ->setIsActive(true);

        $brand2 = new Brand();
        $brand2->setName('Brand #2')
            ->setIsActive(true);

        $manager->persist($brand1);
        $manager->persist($brand2);
        $manager->flush();

        $this->addReference('brand1', $brand1);
        $this->addReference('brand2', $brand2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
