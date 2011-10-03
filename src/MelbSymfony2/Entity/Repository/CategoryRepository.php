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
    public function findAllProductsForCategory()
    {
        return array();
    }
}
