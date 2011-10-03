<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace MelbSymfony2\Entity\Repository;
/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByPriceRange($min, $max)
    {
        $em = $this->getEntityManager();

        // Use the DQL query builder
        $query = $em->createQuery(
            'SELECT p FROM MelbSymfony2\Entity\Product p WHERE p.price >= :price_min AND p.price <= :price_max ORDER BY p.price ASC')
                ->setParameter('price_min', $min)
                ->setParameter('price_max', $max);

        
        return $query->getResult();
    }
}
