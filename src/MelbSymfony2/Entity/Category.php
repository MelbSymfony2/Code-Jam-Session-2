<?php
/*
 * Copyright Cameron Manderson (c) 2011 All rights reserved.
 * Date: 3/10/11
 */
namespace MelbSymfony2\Entity;

use Gedmo\Mapping\Annotation as gedmo;

/**
 * @Entity(repositoryClass="MelbSymfony2\Entity\Repository\CategoryRepository")
 * @Table
 * @gedmo\Tree(type="nested")
 * @author camm (camm@flintinteractive.com.au)
 */
class Category implements \Gedmo\Tree\Node
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
     * @Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * @OneToMany(targetEntity="Product", mappedBy="category")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $products;

    /**
     * @gedmo\TreeParent
     * @ManyToOne(targetEntity="Category", inversedBy="children")
     * @var Category
     */
    protected $parent;

    /**
     * @OneToMany(targetEntity="Category", mappedBy="parent")
     * @OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @gedmo\TreeLeft
     * @Column(name="lft", type="integer")
     */
    protected $left;

    /**
     * @gedmo\TreeRight
     * @Column(name="rgt", type="integer")
     */
    protected $right;

    /**
     * @gedmo\TreeRoot
     * @Column(name="root", type="integer")
     */
    protected $root;

    /**
     * @gedmo\TreeLevel
     * @Column(name="lvl", type="integer")
     */
    protected $level;

    /**
     * @gedmo\Slug(fields={"name"})
     * @Column(name="slug", type="string", length=128, unique=true)
     * @var string
     */
    protected $slug;


    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setRoot($root)
    {
        $this->root = $root;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function setRight($right)
    {
        $this->right = $right;
    }

    public function getRight()
    {
        return $this->right;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLeft($left)
    {
        $this->left = $left;
    }

    public function getLeft()
    {
        return $this->left;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function getChildren()
    {
        return $this->children;
    }
}
