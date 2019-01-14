<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Usuarios|null find($dni, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }

    // /**
    //  * @return Usuarios[] Returns an array of Usuarios objects
    //  */

    // Este método trae solo los datos de dni y nyape del usuario, buscandolo por DNI
    public function findByDni($dni){
        
        return $this->createQueryBuilder('u')
            ->select('u.dni, u.nyape')
            ->andWhere('u.dni = :dni')
            ->setParameter('dni', $dni)
            ->getQuery()
            ->getResult()
        ;
    }
}
