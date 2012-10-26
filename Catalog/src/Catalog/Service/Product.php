<?php

namespace Catalog\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Catalog\Repository\Product as ProductRepository;
use Catalog\Entity\Product as ProductEntity;
use Catalog\Form\Product as ProductForm;

class Product implements ServiceManagerAwareInterface
{
    /**
     * @var ProductForm 
     */
    protected $form;

    /**
     * @var ProductRepository 
     */
    protected $repository;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @param type $id
     * @return ProductEntity
     */
    public function getProductById($id)
    {
        return  $this->repository->find($id);
    }

    /**
     * @return array 
     */
    public function getAllProducts()
    {
        return  $this->repository->findAll();
    }

    /**
     *
     * @param type $category
     * @param type $association
     * @return type 
     */
    public function getProductsByCategory($category, $association)
    {
        return  $this->repository;
    }
    
    /**
     * @param type $data
     * @return type 
     */
    public function addProduct($data)
    {
        $product = new ProductEntity();
        $form = $this->getProductForm();
        $form->setHydrator(new ClassMethods());
        $form->bind($product);
        $form->setData($data);
        if (!$form->isValid()) {
            return false;
        }
        $product = $form->getData();
        $this->repository->saveEntity($product);
        return $product;
    }
    
    /**
     * @param type $product
     * @return type 
     */
    public function removeProduct($product)
    {
        return $this->repository->removeEntity($product);
    }
    
    /**
     * @return Form
     */
    public function getProductForm() {
        return $this->form;
    }

    /**
     * @param Form $form
     * @return Product
     */
    public function setProductForm(ProductForm $form) {
        $this->form = $form;
        return $this;
    }
    
    /**
     *
     * @param ProductRepository $repository
     * @return Product 
     */
    public function setRepository(ProductRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return Product
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this;
    }

}
