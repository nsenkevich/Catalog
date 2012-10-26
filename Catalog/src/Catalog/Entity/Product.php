<?php

namespace Catalog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="Catalog\Repository\Product")
 * @ORM\Table(name="products")
 */
class Product extends ProductValidation
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $productId;
    /**
     * @ORM\ManyToOne(targetEntity="Package");
     * @ORM\JoinColumn(name="packageId", referencedColumnName="packageId");
     */
    protected $package;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductGroup");
     * @ORM\JoinColumn(name="productGroupId", referencedColumnName="productGroupId");
     */
    protected $group;
    
    /**
     * @ORM\OneToOne(targetEntity="OrderItems");
     * @ORM\JoinColumn(name="productId", referencedColumnName="productId");
     */
    protected $orderProduct;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $type;
    
    /**
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\Column(type="string")
     */
    protected $packageId;
    
     /**
     * @ORM\Column(type="string")
     */
     protected $productGroupId;
     
    /**
     * @ORM\Column(type="string")
     */
     protected $options;
     
    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
    
}