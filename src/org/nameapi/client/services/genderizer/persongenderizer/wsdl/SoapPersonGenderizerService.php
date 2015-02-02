<?php

namespace org\nameapi\client\services\genderizer\persongenderizer\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/AssessArguments.php');
require_once(__DIR__.'/AssessResponse.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 * Use the PersonGenderizerService, this is wsdl internal only.
 */
class SoapPersonGenderizerService extends BaseSoapClient {

    private static $classmap = array(
        'assess'           => '\org\nameapi\client\services\genderizer\persongenderizer\wsdl\AssessArguments',
        'assessResponse'   => '\org\nameapi\client\services\genderizer\persongenderizer\wsdl\AssessResponse',
        //'soapGenderResult' => '\org\nameapi\client\services\genderizer\persongenderizer\GenderResult',
    );

    /**
     */
    public function __construct(array $options = array(), $baseUrl) {
        parent::__construct($baseUrl.'genderizer/persongenderizer?wsdl', self::$classmap, $options);
    }

    /**
     * @param AssessArguments $parameters
     * @return AssessResponse
     */
    public function assess(AssessArguments $parameters) {
        return $this->__soapCall('assess', array($parameters));
    }

}
