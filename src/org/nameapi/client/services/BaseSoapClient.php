<?php

namespace org\nameapi\client\services;

require_once(__DIR__.'/ServiceFactory.php');

if (!extension_loaded('soap')) {
    exit("Error: missing php_soap library, enable it in php.ini!");
}

/**
 */
abstract class BaseSoapClient extends \SoapClient {

    public function __construct($wsdl, array $classmap=array(), array $options=array()) {
        BaseSoapClient::mergeClassmap($options, $classmap, ServiceFactory::$classmap);
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;
        parent::__construct($wsdl, $options);
    }


    private static function mergeClassmap(&$options, $map1, $map2) {
        if (!isset($options['classmap'])) {
            $options['classmap'] = array();
        }
        $array = &$options['classmap'];
        BaseSoapClient::mergeMap($array, $map1);
        BaseSoapClient::mergeMap($array, $map2);
    }
    private static function mergeMap(&$array, $map) {
        foreach ($map as $key => $value) {
            if (isset($array[$key])) {
                throw new \Exception("Already defined key ".$key. " for value: ".$array[$key]);
            }
            $array[$key] = $value;
        }
    }

}
