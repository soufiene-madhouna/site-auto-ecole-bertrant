<?php

namespace TransporteursBundle\Repository;

/**
 * VoyageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VoyageRepository extends \Doctrine\ORM\EntityRepository
{
	public function getTransporteurTrajets($id)
	{
		$qb = $this->createQueryBuilder('v')
		           ->where(" v.Parcours = $id");
		$query = $qb->getQuery(); // return a new Query object
		$results = $query->getResult(); // get the results of the query
		return $results;
	}
}
