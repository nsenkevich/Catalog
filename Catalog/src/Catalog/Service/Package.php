<?php

namespace Catalog\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Catalog\Repository\Package as PackageRepository;
use Catalog\Entity\Package as PackageEntity;
use Catalog\Form\Package as PackageForm;

class Package implements ServiceManagerAwareInterface
{
    /**
     * @var PackageForm 
     */
    protected $form;

    /**
     * @var PackageRepository 
     */
    protected $repository;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @param type $id
     * @return PackageEntity
     */
    public function getPackageById($id)
    {
        return  $this->repository->find($id);
    }

    /**
     * @return array 
     */
    public function getAllPackages()
    {
        return  $this->repository->findAll();
    }

    /**
     * @param type $package
     * @param type $category 
     */
    public function hasPackageCategory($package, $category)
    {
        return  $this->repository->findAll();
    }
    
    /**
     * @param type $package 
     */    
    public function getCategoryByPackages($package)
    {
        return  $this->repository->findAll();
    }
    
    /**
     * @param type $data
     * @return type 
     */
    public function addPackage($data)
    {
        $package = new PackageEntity();
        $form = $this->getPackageForm();
        $form->setHydrator(new ClassMethods());
        $form->bind($package);
        $form->setData($data);
        if (!$form->isValid()) {
            return false;
        }
        $package = $form->getData();
        $this->repository->saveEntity($package);
        return $package;
    }
    
    /**
     * @param type $package
     * @return type 
     */
    public function removePackage($package)
    {
        return $this->repository->removeEntity($package);
    }
    
    /**
     * @return Form
     */
    public function getPackageForm() {
        return $this->form;
    }

    /**
     * @param Form $form
     * @return Package
     */
    public function setPackageForm(PackageForm $form) {
        $this->form = $form;
        return $this;
    }
    
    /**
     *
     * @param PackageRepository $repository
     * @return Package 
     */
    public function setRepository(PackageRepository $repository)
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
     * @return Package
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this;
    }

}
