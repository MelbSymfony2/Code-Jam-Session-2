<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace MelbSymfony2\Entity;

use Gedmo\Tree\Node as NodeInterface,
Gedmo\Mapping\Annotation as gedmo;

/**
 * @Entity(repositoryClass="MelbSymfony2\Entity\Repository\ProductRepository")
 * @Table
 * @author camm (camm@flintinteractive.com.au)
 */
class Product 
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @Column
     * @var string
     */
    protected $name;

    /**
     * @Column(type="decimal", precision=2, scale=1)
     * @var float
     */
    protected $price;

    /**
     * @Column
     * @var string
     */
    protected $description;

    /**
     * @ManyToOne(targetEntity="Category", inversedBy="products")
     * @var Category
     */
    protected $category;

    /**
     * @Column(name="slug", type="string", length=128, unique=true)
     * @gedmo\Slug(fields={"name"})
     * @var string
     */
    protected $slug;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
