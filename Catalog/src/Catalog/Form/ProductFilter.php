<?php

namespace Catalog\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class ProductFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
* Convert the object to an array.
*
* @return array
*/
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
* Populate from an array.
*
* @param array $data
*/
    public function populate($data = array())
    {
        $this->id = $data['id'];
        $this->packageId = $data['packageId'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->type = $data['type'];
        $this->options = $data['options'];
        $this->productGroupId = $data['productGroupId'];
        $this->price = $data['price'];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'packageId',
                'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'productGroupId',
                'required' => true,
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'options',
                'required' => true,
            )));
//            $inputFilter->add($factory->createInput(array(
//                'name' => 'package',
//                'required' => true,
//            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'type',
                'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'description',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 300,
                        ),
                    ),
                ),
            )));
            
            
//            $inputFilter->add($factory->createInput(array(
//                'name' => 'options',
//                'required' => true,
//                'filters' => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                'validators' => array(
//                    array(
//                        'name' => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min' => 1,
//                            'max' => 100,
//                        ),
//                    ),
//                ),
//            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'price',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}

