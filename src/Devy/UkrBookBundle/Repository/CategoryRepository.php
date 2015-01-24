<?php

namespace Devy\UkrBookBundle\Repository;

use Devy\UkrBookBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @return Category[]
     */
    public function getTopLevel()
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.is_active = 1')
            ->andWhere('c.Parent IS NULL');
        try {
            $categories = $qb->getQuery()->getResult();
        } catch (NoResultException $e) {
            $categories = array();
        }
        return $categories;
    }
}