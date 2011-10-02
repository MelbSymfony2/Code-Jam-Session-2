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
class ProductTest extends ProductCatalogueTestCase
{
    public function testCreate()
    {
        // Create our product
        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();

        $this->assertNotEmpty($product->getId(), 'Should have generated an ID for our product');
    }

    public function testRetrieve()
    {
        // Create and persist our product
        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();

        // Test basic retrieval
        $repository = $em->getRepository('MelbSymfony2\Entity\Product');
        $productMatch = $repository->findOneById($product->getId());
        $this->assertEquals($productMatch, $product, 'Should have retrieved our product');
        $this->assertEquals($productMatch->getPrice(), $product->getPrice(), 'Should have matched our price');
        $this->assertEquals($productMatch->getDescription(), $product->getDescription(), 'Should have matched our description');
    }

    public function testDelete()
    {
        // Create our product
        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();

        $repository = $em->getRepository('MelbSymfony2\Entity\Product');
        $productMatch = $repository->findOneById($product->getId());

        $em->remove($productMatch);
        $em->flush();

        $productMatch = $repository->findOneById($product->getId());
        $this->assertEmpty($productMatch, 'Should not have been able to locate the product again after delete');
    }

    public function testUpdate()
    {
        // Create our product
        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');

        // Persist
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();

        $repository = $em->getRepository('MelbSymfony2\Entity\Product');
        $productMatch = $repository->findOneById($product->getId());

        $productMatch->setPrice('13.95');
        $repository->flush();

        $productMatch = $repository->findOneById($product->getId());
        $this->assertEquals($productMatch->getPrice(), '13.95', 'Should have the updated price');
    }

    public function testCategory()
    {
        $category = new Category();
        $category->setName('Test product');
        $category->setDescription('Our test product');
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();

        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');
        $product->setCategory($category);

        $em->persist($product);
        $em->flush();

        $repository = $em->getRepository('MelbSymfony2\Entity\Product');
        $productMatch = $repository->findOneById($product->getId());
        $this->assertNotEmpty($productMatch->getCategory(), 'Should have a category');
        $this->assertEquals($productMatch->getCategory()->getId(), $category->getId(), 'Should have matched our category');
    }

    public function testSlug()
    {
        $product = new Product();
        $product->setName('Test product');
        $product->setPrice('12.95');
        $product->setDescription('Our test product');
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush();

        $this->assertNotEmpty($product->getSlug(), 'Should have generated a slug value for this entity');
    }

    public function testRetrieveByPriceRange()
    {
        $em = $this->getEntityManager();
        $repository = $em->getRepository('MelbSymfony2\Entity\Product');
        $this->assertTrue(method_exists($repository, 'findByPriceRange'), 'Should have defined a function findByPriceRange');

        $productA = new Product();
        $productA->setName('Product A');
        $productA->setDescription('Lorem');
        $productA->setPrice('12.95');
        $em->persist($productA);

        $productB = new Product();
        $productB->setName('Product B');
        $productB->setDescription('Lorem');
        $productB->setPrice('9.95');
        $em->persist($productB);

        $this->assertEquals(2, count($repository->findByPriceRange('0.00', '100.00')), 'Should have found both products');
        $this->assertEquals(1, count($repository->findByPriceRange('0.00', '10.00')), 'Should have found one product');
        $this->assertEquals(1, count($repository->findByPriceRange('10.00', '100.00')), 'Should have found one product');
        $this->assertEquals(1, count($repository->findByPriceRange('0.00', '5.00')), 'Should have no products');

        $results = $repository->findByPriceRange('0.00', '10.00');
        $this->assertEquals($productB, $results[0], 'Should have found Product B for price range 0 - 10');

        $results = $repository->findByPriceRange('10.00', '100.00');
        $this->assertEquals($productA, $results[0], 'Should have found Product A for price range 10 - 100');

    }
}
