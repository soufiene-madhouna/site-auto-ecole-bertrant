<?php

namespace TransporteursBundle\Repository;

/**
 * TransporteursRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransporteursRepository extends \Doctrine\ORM\EntityRepository
{
	public function DejaTransporteur($user){
	
		
			$qb = $this->createQueryBuilder('p')
			->where(" p.User = $user");
			$query = $qb->getQuery(); // return a new Query object
			$results = $query->getResult(); // get the results of the query
			//dump($results);
			if ($results) {$retoure=1; }else {$retoure=0;} ;
					
		return $retoure;
	}
	
	public function IdTransporteur($user){
	
		$qb = $this->createQueryBuilder('p');
		$qb->select('p.id')
		->where(" p.User = $user");
		$query = $qb->getQuery(); // return a new Query object
		$results = $query->getResult(); // get the results of the query
		return $results;
	}
}