<?php

namespace App\Repository;

use App\Entity\Infracciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Infracciones|null find($dni, $lockMode = null, $lockVersion = null)
 * @method Infracciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infracciones[]    findAll()
 * @method Infracciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfraccionesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Infracciones::class);
    }


}
