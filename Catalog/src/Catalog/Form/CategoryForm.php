<?php
namespace Catalog\Form;

use Zend\Form\Form;

class CategoryForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setName('package');
        $this->setAttribute('method', 'post');

        // Id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        // Artist        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Package Name',
            ),
        ));

        $this->add(array(
            'name' => 'price',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Package Price',
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

    }
}
