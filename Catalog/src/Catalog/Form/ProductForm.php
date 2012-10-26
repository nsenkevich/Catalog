<?php
namespace Catalog\Form;

use Zend\Form\Form;

class ProductForm extends Form
{
    // tags
	const MARKUP = 'MARKUP';
	const CSS = 'CSS';
	const COMPABILITY_ACCESABILITY = 'COMPABILITY_ACCESABILITY';
	const JS_PHP_ADDONS = 'JS_PHP_ADDONS';
	const OTHER = 'OTHER';
	
    
    static public $options = Array(
        '--Select--'=>'',
		self::MARKUP => 'MARKUP',
		self::CSS => 'CSS',
        self::COMPABILITY_ACCESABILITY => 'COMPABILITY_ACCESABILITY',
        self::JS_PHP_ADDONS => 'JS_PHP_ADDONS',
        self::OTHER => 'OTHER'
	);
    
    
        // tags
	const ADDONS = 'ADDONS';
	const PRICETABLE = 'PRICETABLE';
	
    
    static public $productTypes = Array(
        '--Select--'=>'',
		self::ADDONS => 'ADDONS',
		self::PRICETABLE => 'PRICETABLE',
	);
    
    public function __construct($em)
    {
        parent::__construct();

        $this->setName('product');
        $this->setAttribute('method', 'post');

        // Id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        // Product       
        $this->add(array(
            'name' => 'packageId',
            'attributes' => array(
                'type'  => 'select',
                'label' => 'Package',
                'options' => array(),
            ),
        ));
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
                'label' => 'Description',
            ),
        ));
        
//        $this->add(array(
//            'name' => 'productGroupName',
//            'attributes' => array(
//                'type'  => 'text',
//                'label' => 'Options',
//            ),
//        ));

        $this->add(array(
            'name' => 'options',
            'attributes' => array(
                'type'  => 'select',
                'label' => 'Options',
                'options' => self::$options,
            ),
        ));
                
        $this->add(array(
            'name' => 'productGroupId',
            'attributes' => array(
                'type'  => 'select',
                'label' => 'Category',
                'options' => array(),
            ),
        ));
        
        $this->add(array(
            'name' => 'type',
            'attributes' => array(
                'type'  => 'select',
                'label' => 'Types',
                'options' => self::$productTypes,
            ),
        ));
        
       $this->add(array(
            'name' => 'price',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Price',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'label' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $this->setProductPackages($em->getRepository('Album\Entity\Package')->findAll());       
        $this->setProductGropus($em->getRepository('Album\Entity\ProductGroup')->findAll());
    }
    
    
    public function setProductPackages($packages)
    {
        $packagesForm = array('--Select--'=>'');
      foreach ($packages as $package) {
            $packagesForm[$package->name] = (string) $package->packageId;
        }
        $this->get('packageId')->setAttribute('options',$packagesForm);  
    }
    
    public function setProductGropus($groups)
    {
      $groupsForm = array('--Select--'=>'');
      foreach ($groups as $group) {
            $groupsForm[$group->name] = (string) $group->productGroupId;
        }
        $this->get('productGroupId')->setAttribute('options',$groupsForm);  
    }
}
