<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findBestSeries()
    {
        //en DQL
        //$entityManager = $this->getEntityManager();
        /*$dql = "
            SELECT alias
            FROM App\Entity\Serie alias
            WHERE alias.popularity > 100
            AND alias.vote > 8
            ORDER BY alias.popularity DESC
            ";
        */
        //$query = $entityManager->createQuery($dql);
        //$query->setMaxResults(20);
        //$result=  $query->getResult();

        //version QueryBuilder
        $queryBuilder = $this->createQueryBuilder('alias');
        $queryBuilder
            ->andWhere('alias.popularity > 100')
            ->andWhere('alias.vote > 8');
        $queryBuilder->addOrderBy('alias.popularity', 'DESC');
        $query = $queryBuilder->getQuery();
        $query->setMaxResults(20);
        $result=  $query->getResult();


        return $result;
    }





}