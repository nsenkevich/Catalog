<?php

namespace Catalog\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Catalog\Repository\Category as CategoryRepository;
use Catalog\Entity\Category as CategoryEntity;
use Catalog\Form\Category as CategoryForm;

class Category implements ServiceManagerAwareInterface
{
    /**
     * @var CategoryForm 
     */
    protected $form;

    /**
     * @var CategoryRepository 
     */
    protected $repository;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @param type $id
     * @return CategoryEntity
     */
    public function getCategoryById($id)
    {
        return  $this->repository->find($id);
    }

    /**
     * @return array 
     */
    public function getAllCategories()
    {
        return  $this->repository->findAll();
    }

    /**
     * @param type $parentID 
     */
    public function getCategoriesByParentId($parentID)
    {
        return  $this->repository->findAll();
    }   
    
    public function getCategoriesByPackage($id)
    {
        return  $this->repository->findAll();
    }   
    
    /**
     * @param type $data
     * @return type 
     */
    public function addCategory($data)
    {
        $category = new CategoryEntity();
        $form = $this->getCategoryForm();
        $form->setHydrator(new ClassMethods());
        $form->bind($category);
        $form->setData($data);
        if (!$form->isValid()) {
            return false;
        }
        $category = $form->getData();
        $this->repository->saveEntity($category);
        return $category;
    }
    
    /**
     * @param type $category
     * @return type 
     */
    public function removeCategory($category)
    {
        return $this->repository->removeEntity($category);
    }
    


 
    //-------------------------------------------------------------------------
    
    /**
     * @return Form
     */
    public function getCategoryForm() {
        return $this->form;
    }
    
    /**
     * @param Form $form
     * @return Category
     */
    public function setCategoryForm(CategoryForm $form) {
        $this->form = $form;
        return $this;
    }
    
    /**
     *
     * @param CategoryRepository $repository
     * @return Category 
     */
    public function setRepository(CategoryRepository $repository)
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
     * @return Category
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this;
    }

}
