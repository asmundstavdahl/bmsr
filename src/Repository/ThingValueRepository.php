<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Thing;
use App\Entity\ThingValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ThingValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThingValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThingValue[]    findAll()
 * @method ThingValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThingValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ThingValue::class);
    }

    public function findByThing(Thing $thing)
    {
        return $this->createQueryBuilder('t')
            ->where('t.thing = :thing')->setParameter('thing', $thing)
            ->leftJoin(Property::class, 'p')
            ->orderBy('p.sortnum', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
}
