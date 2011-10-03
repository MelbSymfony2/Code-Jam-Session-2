This is the repository from the 2nd Melbourne Symfony2 code jam, hosted on September 6th, 2011 at [Flint Interactive](http://www.flintinteractive.com.au). 11 developers attended the evening, and the goal of tonight was to get developers familiar with Doctrine2 ORM for model development.

The night was presented by [Cam Manderson](https://github.com/cammanderson) and [Sam Jarrett](https://github.com/samjarrett) coded as we went on screen.

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

## Tasks

### Implement a basic Product/Catalogue Model

The model was intended to remain basic and be enough to cover more of the implementation topics of annotations, persistence, repository etc.

* Product and Category Entities
* Product to have: name, description, price and category
* Category to have: name, description
* Both product and category to have a slug field that is sluggable
* Category has a parent

The category needs to implement a parent allowing for us later to try a more complex tree with an unknown depth. This allows us to tackle the challenge of having products associated to sub-categories and have them show up by retrieving the parent category.

## Implement the basic tests

We also suggested on the night that people implement the following tests so that they can test their model as working.

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

# Proposed Solutions

These solutions are contributed by [Cameron Manderson](https://github.com/cammanderson).

They are split up into 3 stages:

* From scratch: You can do everything from the base test harness
* Tests only: Having the tests written, you can develop your model and test whether it working as you go
* Completed model: The solution for you to follow

You can download them and in your command line run `phpunit`. This will run the tests that you have implemented.

## Start from scratch
Download the [Doctrine Test Case Boiler Plate](https://github.com/MelbSymfony2/Doctrine2-Test-Case-Boiler-Plate) and write your solution.

## Tests only, leaving you to write the model
Download the v1.0 of this package. This is the implementation of only the PHP Tests. You can then implement your ORM model as necessary

## Completed model, no work to be done
Download the v1.0.1 of this package. This implementation has the complete solution, including tests and a working model.

# Helpful References

* [Simple entity annotations](http://www.doctrine-project.org/docs/orm/2.0/en/reference/annotations-reference.html)
* [Writing Doctrine Fixtures](http://symfony.com/doc/2.0/bundles/DoctrineFixturesBundle/index.html)
* [DoctrineExtensions Slug behaviour reference](http://gediminasm.org/article/sluggable-behavior-extension-for-doctrine-2)
* [DoctrineExtensions Nested Set behaviour reference](http://gediminasm.org/article/tree-nestedset-behavior-extension-for-doctrine-2)

# Want to keep going?

Want to continue and take this to the next level?

* Add version and log behaviour to the update behaviour
* Add a created/updated timestamp to the entities
* Add related products to the product catalogue and have them automatically loaded with one DB call