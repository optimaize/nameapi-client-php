<?php

namespace org\nameapi\client\services\formatter\personnameformatter\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/FormatPersonNameArguments.php');
require_once(__DIR__ . '/../../wsdl/SoapFormatterProperties.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 * Use the PersonNameFormatterService, this is wsdl internal only.
 */
class SoapPersonNameFormatterService extends BaseSoapClient {

    private static $classmap = array(
    );

    public function __construct(array $options = array(), $baseUrl) {
        parent::__construct($baseUrl.'formatter/personnameformatter?wsdl', self::$classmap, $options);
    }

    public function format(FormatPersonNameArguments $parameters) {
        return $this->__soapCall('format', array($parameters));
    }

}
