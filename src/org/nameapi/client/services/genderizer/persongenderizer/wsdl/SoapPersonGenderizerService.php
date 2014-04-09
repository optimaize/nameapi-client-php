<?php

namespace org\nameapi\client\services\genderizer\persongenderizer\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/../../../Util.php');
require_once('AssessArguments.php');
require_once('AssessResponse.php');
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
    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/genderizer/persongenderizer?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    /**
     * @param AssessArguments $parameters
     * @return AssessResponse
     */
    public function assess(AssessArguments $parameters) {
        return $this->__soapCall('assess', array($parameters));
    }

}
