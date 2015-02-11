<?php

namespace Devy\UkrBookBundle\DataFixtures\ORM;

use Devy\UkrBookBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadPostData
 * @package Devy\UkrBookBundle\DataFixtures\ORM
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setTitle('Post #1')
            ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet bibendum ante, gravida
            suscipit dui. Praesent a nunc lorem. Aliquam erat volutpat. Suspendisse eget nisl mattis, rhoncus quam nec,
            hendrerit elit. Aenean neque ipsum, aliquam porta felis et, pretium efficitur erat. Donec consequat quis
            erat at malesuada. Cras id ipsum nisl. Duis molestie risus sit amet volutpat porta. Phasellus urna velit,
            consectetur in ante ut, scelerisque dignissim ex. Nunc elementum porttitor nulla a lacinia.
            Fusce fermentum non diam finibus sollicitudin. Maecenas rhoncus turpis mollis egestas varius.
            Nulla varius, ante et porttitor consequat, libero neque luctus ligula, nec malesuada elit diam
            sed ipsum. Quisque vitae dui malesuada, porta tortor nec, cursus dolor. Vivamus mi tellus,
            congue ut semper in, consectetur sed metus. Nulla ut tortor et risus aliquet mattis ac congue eros.
            Maecenas ultrices, mauris eget faucibus porta, magna sem vulputate urna, at lacinia eros lacus et justo.
            Fusce id viverra urna. Duis vitae neque vitae risus consectetur lacinia. Nunc maximus massa efficitur nunc
            posuere, eu interdum quam luctus. Nulla facilisi.')
            ->setIsActive(true);

        $post2 = new Post();
        $post2->setTitle('Post #2')
            ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet bibendum ante, gravida
            suscipit dui. Praesent a nunc lorem. Aliquam erat volutpat. Suspendisse eget nisl mattis, rhoncus quam nec,
            hendrerit elit. Aenean neque ipsum, aliquam porta felis et, pretium efficitur erat. Donec consequat quis
            erat at malesuada. Cras id ipsum nisl. Duis molestie risus sit amet volutpat porta. Phasellus urna velit,
            consectetur in ante ut, scelerisque dignissim ex. Nunc elementum porttitor nulla a lacinia.
            Fusce fermentum non diam finibus sollicitudin. Maecenas rhoncus turpis mollis egestas varius.
            Nulla varius, ante et porttitor consequat, libero neque luctus ligula, nec malesuada elit diam
            sed ipsum. Quisque vitae dui malesuada, porta tortor nec, cursus dolor. Vivamus mi tellus,
            congue ut semper in, consectetur sed metus. Nulla ut tortor et risus aliquet mattis ac congue eros.
            Maecenas ultrices, mauris eget faucibus porta, magna sem vulputate urna, at lacinia eros lacus et justo.
            Fusce id viverra urna. Duis vitae neque vitae risus consectetur lacinia. Nunc maximus massa efficitur nunc
            posuere, eu interdum quam luctus. Nulla facilisi.')
            ->setIsActive(true);

        $manager->persist($post1);
        $manager->persist($post2);
        $manager->flush();
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
