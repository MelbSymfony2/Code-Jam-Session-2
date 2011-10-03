<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace CodeJamTestSuite\Entity;
use MelbSymfony2\Entity\Product;
use MelbSymfony2\Entity\Category;
/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
class CategoryTest extends ProductCatalogueTestCase
{
    public function testCreate()
    {
        // Create our category
        $category = new Category();
        $category->setName('Test category');
        $category->setDescription('Our test category');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        $this->assertNotEmpty($category->getId(), 'Should have generated an ID for our category');
    }

    public function testRetrieve()
    {
        // Create and persist our category
        $category = new Category();
        $category->setName('Test category');
        $category->setDescription('Our test category');
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        // Test basic retrieval
        $repository = $em->getRepository('MelbSymfony2\Entity\Category');
        $categoryMatch = $repository->findOneById($category->getId());
        $this->assertEquals($categoryMatch, $category, 'Should have retrieved our category');
        $this->assertEquals($categoryMatch->getDescription(), $category->getDescription(), 'Should have matched our description');
    }

    public function testDelete()
    {
        // Create our category
        $category = new Category();
        $category->setName('Test category');
        $category->setDescription('Our test category');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        $id = $category->getId();

        $repository = $em->getRepository('MelbSymfony2\Entity\Category');
        $categoryMatch = $repository->findOneById($id);

        $em->remove($categoryMatch);
        $em->flush();

        $categoryMatch = $repository->findOneById($id);
        $this->assertEmpty($categoryMatch, 'Should not have been able to locate the category again after delete');
    }

    public function testUpdate()
    {
        // Create our category
        $category = new Category();
        $category->setName('Test category');
        $category->setDescription('Our test category');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        $repository = $em->getRepository('MelbSymfony2\Entity\Category');
        $categoryMatch = $repository->findOneById($category->getId());

        $categoryMatch->setDescription('Our test category 2');
        $em->flush();

        $categoryMatch = $repository->findOneById($category->getId());
        $this->assertEquals($categoryMatch->getDescription(), 'Our test category 2', 'Should have the updated description');
    }

    public function testSlug()
    {
        $category = new Category();
        $category->setName('Test category');
        $category->setDescription('Our test category');
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        $this->assertNotEmpty($category->getSlug(), 'Should have generated a slug value for this entity');
    }

    public function testNestedSet()
    {
        $this->loadFixture('CodeJamTestSuite\DataFixtures\ORM\ProductCatalogueFixture');

        $em = $this->getEntityManager();

        $repository = $em->getRepository('MelbSymfony2\Entity\Category');
        $this->assertTrue(method_exists($repository, 'childCount'));
        $this->assertEquals(3, $repository->childCount($repository->findOneByName('Category A')), 'Should have 3 children overall');
        $this->assertEquals(2, $repository->childCount($repository->findOneByName('Category A'), true), 'Should have 2 direct children');
        $this->assertEquals(1, $repository->childCount($repository->findOneByName('Category D')), 'Should have 1 child');
    }

    public function testRetrieveAllProductsByCategory()
    {
        $this->loadFixture('CodeJamTestSuite\DataFixtures\ORM\ProductCatalogueFixture');

        $em = $this->getEntityManager();

        $repository = $em->getRepository('MelbSymfony2\Entity\Category');
        $this->assertTrue(method_exists($repository, 'findAllProductsForCategory'), 'Should have defined a function findAllProductsForCategory');
        $this->assertEquals(4, $repository->findAllProductsForCategory($repository->findOneByName('Category A')), 'Should have 4 products');
        $this->assertEquals(1, $repository->findAllProductsForCategory($repository->findOneByName('Category B')), 'Should have 1 product');
        $this->assertEquals(2, $repository->findAllProductsForCategory($repository->findOneByName('Category C')), 'Should have 2 product');
        $this->assertEquals(2, $repository->findAllProductsForCategory($repository->findOneByName('Category D')), 'Should have 1 product');

    }
}
