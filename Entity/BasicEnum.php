<?php

namespace Joseroes\EnumBundle\Entity;

/**
 * BasicEnum
 *
 */
abstract class BasicEnum{

    public static function getConstants() {
        $reflect = new \ReflectionClass(get_called_class());
        return $reflect->getConstants();
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }

    public static function getValue($key){
        $reflect = new \ReflectionClass(get_called_class());
        $value = $reflect->getConstant($key);
        return $value;        
    }

    public static function getKey($value){
        $key = false;
        if (self::$constCache === NULL) {
            $reflect = new \ReflectionClass(get_called_class());
            self::$constCache = $reflect->getConstants();
        }    
        foreach (self::$constCache as $constkey => $constValue) {
            if($value === $constValue){
                $key = $constkey;
            }    
        } 
        return $key;
    }
}
