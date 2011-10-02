<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 6/09/11
 */
namespace CodeJamTestSuite\Entity;
/**
 *
 * @author camm (camm@flintinteractive.com.au)
 */
class EnvironmentTest extends EntityTestCase
{
    public function testObtainEntityManager()
    {
        $this->assertNotEmpty($this->getEntityManager(), 'Failed to connect the entity manager');
    }
}
