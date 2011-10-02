<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace CodeJamTestSuite\DataFixtures\ORM;
/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
class ProductCatalogueFixture
{
    public function load($em)
    {
        $categoryA = new Category();
        $categoryA->setName('Category A');
        $categoryA->setDescription('Lorem ipsum');
        $em->persist($categoryA);
        $em->flush();

        $categoryB = new Category();
        $categoryB->setName('Category B');
        $categoryB->setDescription('Lorem ipsum');
        $categoryB->setParent($categoryA);
        $em->persist($categoryB);

        $categoryC = new Category();
        $categoryC->setName('Category C');
        $categoryC->setDescription('Lorem ipsum');
        $categoryC->setParent($categoryA);
        $em->persist($categoryC);

        $categoryD = new Category();
        $categoryD->setName('Category D');
        $categoryD->setDescription('Lorem ipsum');
        $categoryD->setParent($categoryC);
        $em->persist($categoryD);
        $em->flush();

        $productA = new Product();
        $productA->setName('Product A');
        $productA->setDescription('Lorem');
        $productA->setPrice('12.95');
        $productA->setCategory($categoryA);
        $em->persist($productA);

        $productB = new Product();
        $productB->setName('Product B');
        $productB->setDescription('Lorem');
        $productB->setPrice('9.95');
        $productB->setCategory($categoryB);
        $em->persist($productB);

        $productC = new Product();
        $productC->setName('Product C');
        $productC->setDescription('Lorem');
        $productC->setPrice('11.95');
        $productC->setCategory($categoryC);
        $em->persist($productC);

        $productD = new Product();
        $productD->setName('Product D');
        $productD->setDescription('Lorem');
        $productD->setPrice('29.95');
        $productD->setCategory($categoryD);
        $em->persist($productD);


        $em->flush();
    }
}
