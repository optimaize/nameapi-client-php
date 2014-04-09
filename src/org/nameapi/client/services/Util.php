<?php

namespace org\nameapi\client\services;

/**
 *
 */
class Util {

    static function mergeClassmap(&$options, $map1, $map2) {
        if (!isset($options['classmap'])) {
            $options['classmap'] = array();
        }
        $array = &$options['classmap'];
        Util::mergeMap($array, $map1);
        Util::mergeMap($array, $map2);
    }
    private static function mergeMap(&$array, $map) {
        foreach ($map as $key => $value) {
            if (isset($array[$key])) {
                throw new \Exception("Already defined key "+$key+ " for value: "+$array[$key]);
            }
            $array[$key] = $value;
        }
    }

}
