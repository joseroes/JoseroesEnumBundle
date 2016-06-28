<?php

namespace Joseroes\EnumBundle\Twig;

class EnumTwigExtension extends \Twig_Extension
{
    private $enumService;
    public function __construct($service){
        $this->enumService = $service;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('enum', array($this, 'enumFilter')),
        );
    }

    public function enumFilter($value,$enum)
    {
        return $this->enumService->getConstantTranslatorByValue($enum,$value);
    }

    public function getName()
    {
        return 'enum_extension';
    }
}