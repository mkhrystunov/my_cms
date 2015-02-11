<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Attribute;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAttributeData
 * @package Devy\UkrBookBundle\DataFixtures\ORM
 */
class LoadAttributeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $attribute1 = new Attribute();
        $attribute1->setName('Pages')
            ->setIsActive(true);

        $attribute2 = new Attribute();
        $attribute2->setName('Author')
            ->setIsActive(true);

        $manager->persist($attribute1);
        $manager->persist($attribute2);
        $manager->flush();

        $this->addReference('attribute1', $attribute1);
        $this->addReference('attribute2', $attribute2);
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
