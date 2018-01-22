<?php

namespace Uts\HotelBundle\Repository;

use \Doctrine\ORM\EntityRepository;


use Doctrine\ORM\Query\ResultSetMappingBuilder;

class SearchResult extends EntityRepository
{
    public function createQueryForPagination($requestId)
    {
        $qb = $this->createQueryBuilder('self');
        $qb
            ->join('self.hotel', 'hotel')
            ->leftJoin('self.meal', 'meal')
            ->addSelect('hotel')
           ->addSelect('meal')
           ->distinct('hotel')
            ->andWhere('self.request = ?0')
            ->setParameters(array($requestId))
        ;
        return $qb->getQuery();
    }
/*
    public function hotelsCount($requestId){

   /*  $qb = $this->createQueryBuilder('self');
        $qb
            ->addSelect('COUNT(DISTINCT hotel)')
            ->join('self.hotel', 'hotel')
            ->leftJoin('self.meal', 'meal')
            ->where('self.request = ?0')
            ->setParameters(array($requestId))
        ->getQuery()
          //  ->getSingleScalarResult()
            ;*/
    /*    $qb = $this->createQueryBuilder('self');
        $qb->select('count DISTINCT(p.hotel)');
        $qb->from('HotelBundle:SearchResult','p')
            ->where('p.request_id = :id')
            ->setParameter('id',$requestId);

        $count = $qb->getQuery()->getSingleScalarResult();*/
       /* $qb
            ->join('self.hotel', 'hotel')
            ->leftJoin('self.meal', 'meal')
            ->addSelect('hotel')
            ->addSelect('meal')
            ->andWhere('self.request = ?0')
            ->setParameters(array($requestId))
        ;*/
      // $dql='SELECT DISTINCT COUNT(hotel) FROM Uts\HotelBundle\Entity\SearchResult hotel' where ;
       /* $query = $this->createQueryBulder('SELECT u FROM Uts\HotelBundle\Entity\SearchResult u WHERE u.request_id = 1');
     $rez=$query->getResult();
     //  var_dump($query);


      //  $count = $qb->getQuery();
        return $count;
    }
    */

/*
      public function getHotelsByRequest($requestId){

    $qb = $this->createQueryBuilder('self');
    $qb
        ->join('self.hotel', 'hotel')
        ->where('self.request = :id')
        ->setParameter('id',$requestId)
        ->distinct('self.hotel');
       return $qb->getQuery()->getResult();
    }
*/

    /**/

    public function getHotelsByRequest($requestId){
/*
               $qb = $this->createQueryBuilder('self');
        $qb

            ->distinct('hotel')
            ->join('self.hotel', 'hotel')
            ->where('self.request = :id')
            ->setParameter('id',$requestId);

        return $qb->getQuery()->getResult();*/
        $qb = $this->createQueryBuilder('self');
        $qb
            ->select($qb->expr()->countDistinct('hotel.id'))
            ->join('self.hotel', 'hotel')
            ->where('self.request = :id')
            ->setParameter('id',$requestId);

     //  return $qb->getQuery()->getSingleResult();
        return $qb->getQuery()->getSingleScalarResult();
    }


}