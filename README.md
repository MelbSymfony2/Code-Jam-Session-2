This is the repository from the 2nd Melbourne Symfony2 code jam, hosted on September 6th, 2011 at Flint Interactive. 11 developers attended the evening, and the goal of tonight was to get developers familiar with Doctrine2 ORM for model development. The night was presented by [Cam Manderson](https://github.com/cammanderson) and [Sam Jarrett](https://github.com/samjarrett) coded the demonstration on screen.

# The nights challenge

We wanted to create the most basic of product catalogues, with simple relationships between product and category. To make it interesting, one the ORM is correctly working we aim to implement sluggable and nested sets behaviour to demonstrate ways to make our entities behave in certain ways. We also chose to test as we were going using PHPUnit. To save time, Cam prepared a Doctrine Test Case Boilerplate to get everyone up and running using the entity manager and a local SQLLite database.

Tests were written extending the class: [EntityTestCase](https://github.com/MelbSymfony2/Doctrine2-Test-Case-Boiler-Plate/blob/master/tests/CodeJamTestSuite/Entity/EntityTestCase.php)

The TestCase provided some functions making it easy for attendees to write and test their model.

* getEntityManager()
* loadFixture()
* getQueryCount() resetQueryCount()
* loadSchemas()
* addLifecycleEventListener()
* addLifecycleEventSubscriber()

## Topics covered:

* Doctrine ORM and Annotations
* PHPUnit
* Entity Manager persistence
* Repository and the DQL
* Doctrine Fixtures
* Doctrine Extensions: Sluggable and Nested Sets

## Model overview

* Product and Category Entities
* Product to have: name, description, price and category
* Category to have: name, description
* Both product and category to have a slug field that is sluggable
* Category has a parent

## Tests

### Product

Implement the following tests for testing your model

    public function testCreate()
    public function testRetrieve()
    public function testDelete()
    public function testUpdate()
    public function testCategory()
    public function testSlug()
    public function testRetrieveByPriceRange()

### Category

    public function testCreate()
    public function testRetrieve()
    public function testDelete()
    public function testUpdate()
    public function testSlug()
    public function testNestedSet()
    public function testRetrieveAllProductsByCategory()

# Solutions

These solutions are contributed by [Cameron Manderson](https://github.com/cammanderson).

## Start from scratch
Download the [Doctrine Test Case Boiler Plate](https://github.com/MelbSymfony2/Doctrine2-Test-Case-Boiler-Plate) and write your solution.

## Tests only, leaving you to write the model
Download the v1.0 of this package. This is the implementation of only the PHP Tests. You can then implement your ORM model as necessary

## Completed model, no work to be done
Download the v1.0.1 of this package. This implementation has the complete solution, including tests and a working model.

# References

* [Simple entity annotations](http://www.doctrine-project.org/docs/orm/2.0/en/reference/annotations-reference.html)
* [Writing Doctrine Fixtures](http://symfony.com/doc/2.0/bundles/DoctrineFixturesBundle/index.html)
* [DoctrineExtensions Slug behaviour reference](http://gediminasm.org/article/sluggable-behavior-extension-for-doctrine-2)
* [DoctrineExtensions Nested Set behaviour reference](http://gediminasm.org/article/tree-nestedset-behavior-extension-for-doctrine-2)

# Want to keep going?

Want to continue and take this to the next level?

* Add version and log behaviour to the update behaviour
* Add a created/updated timestamp to the entities
* Add related products to the product catalogue