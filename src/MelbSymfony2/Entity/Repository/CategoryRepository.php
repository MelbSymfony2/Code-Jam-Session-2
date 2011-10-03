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
class CategoryRepository extends \Gedmo\Tree\Entity\Repository\NestedTreeRepository
{
    public function findAllProductsForCategory($category)
    {
        $em = $this->getEntityManager();

        // Get the listing of children for this category
        $categoryIds = array();
        $categoryIds[] = $category->getId();
        
        $matches = $this->children($category);
        foreach($matches as $match) $categoryIds[] = $match->getId();
        
        // Find the related products
        $query = $em->createQuery("SELECT product FROM MelbSymfony2\Entity\Product product WHERE product.category IN(". implode(' ,', $categoryIds) . ")");
        return $query->getResult();
    }
}
