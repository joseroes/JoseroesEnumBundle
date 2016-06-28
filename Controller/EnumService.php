<?php

namespace Joseroes\EnumBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class EnumService  extends ContainerAware
{
    protected $translator;

    private function getArrayFromEnum($enum)
    {
		$enum = trim($enum);
		if(count($enum) === 0)
        {
			$array = array();
		}
        else
        {
            $enumService = $this->container->get($enum);
			$array = $enumService::getConstants();
		}
    	return $array;
    }

    public function __construct($services){
        $this->translator = $services;
    }

    public function getTranslatorConstants($enum)
    {
    	$translatorArray = array();
        foreach ($this->getArrayFromEnum($enum) as $key => $value) {
        	$translatorArray[$value] = $this->getConstantTranslator($enum,$key);
        }
        return $translatorArray;
    }

    public function getConstantTranslator($enum, $key){
    	return $this->translator->trans('enum.'.$enum.'.'.$key);
    }

    public function getConstantKey($enum, $xValue){
        $key = null;
    	foreach ($this->getArrayFromEnum($enum) as $key => $value) {
    		if($xValue == $value){
    			return $key;
    		}
    	}
        return $key;
    }


    public function getConstantTranslatorByValue($enum, $xValue){
    	$key = $this->getConstantKey($enum,$xValue);
    	return $this->getConstantTranslator($enum,$key);
    }
}
