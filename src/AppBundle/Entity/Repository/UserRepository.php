<?php

namespace AppBundle\Entity\Repository;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository{
    /**
     * @param $name
     *
     * @return array
     */
    public function getUserByName($name) {
        $qb = $this->createQueryBuilder('U');
        $qb->where($qb->expr()->eq('U.name', ':name'))->setParameter(':name', $name, Type::STRING);
        return $qb->getQuery()->getResult();
    }
}
