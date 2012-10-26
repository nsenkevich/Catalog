<?php

namespace Catalog\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Catalog\Service\Category,
    Zend\View\Model\ViewModel;

class ProductList extends AbstractHelper
{
    /**
     * Comment Form
     * @var CommentForm
     */
    protected $service;
    
    /**
     * __invoke 
     * 
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($url, $id)
    {
        $vm = new ViewModel(array(
            'list' => $this->getCategoryService()->getCategoriesByPackage($id),
            'url'  => $url,
            'parentId'  => $parentId,
        ));

        $vm->setTemplate('catalog/catalog/list');
        return $this->getView()->render($vm);
    }
    
    public function getCategoryService()
    {
        return $this->service;
    }

    
    public function setCategoryService(Category $service)
    {
        $this->service = $service;
        return $this;
    }
}
