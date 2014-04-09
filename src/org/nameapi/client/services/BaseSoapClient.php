<?php

namespace org\nameapi\client\services;

require_once('ServiceFactory.php');
require_once('Util.php');


/**
 */
abstract class BaseSoapClient extends \SoapClient {

    public function __construct($wsdl, array $classmap=array(), array $options=array()) {
        Util::mergeClassmap($options, $classmap, ServiceFactory::$classmap);
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;
        parent::__construct($wsdl, $options);
    }

}