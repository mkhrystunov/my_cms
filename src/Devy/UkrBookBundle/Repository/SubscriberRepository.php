<?php

namespace Devy\UkrBookBundle\Repository;

use Devy\UkrBookBundle\Entity\Subscriber;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * SubscriberRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubscriberRepository extends EntityRepository
{
    /**
     * @return Subscriber[]
     */
    public function getAllSortedByIsActive()
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.is_active', 'DESC');
        try {
            $subscribers = $qb->getQuery()->getResult();
        } catch (NoResultException $ex) {
            $subscribers = [];
        }
        return $subscribers;
    }
}
