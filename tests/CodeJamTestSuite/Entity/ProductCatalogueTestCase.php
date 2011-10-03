<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace CodeJamTestSuite\Entity;
/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
class ProductCatalogueTestCase extends EntityTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loadSchemas(array(
                               'MelbSymfony2\Entity\Category',
                               'MelbSymfony2\Entity\Product',
                           ));

        // Add sluggable listener
        $sluggableListener = new \Gedmo\Sluggable\SluggableListener();
        $this->addLifecycleEventSubscriber($sluggableListener);

        // Add the nodeset listener
        $treeListener = new \Gedmo\Tree\TreeListener();
        $this->addLifecycleEventSubscriber($treeListener);
    }
}
