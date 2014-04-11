<?php

namespace org\nameapi\client\services\formatter\namefieldformatter\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/FormatNameFieldArguments.php');
require_once(__DIR__ . '/../../wsdl/SoapFormatterProperties.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 * Use the NameFieldFormatterService, this is wsdl internal only.
 */
class SoapNameFieldFormatterService extends BaseSoapClient {

    private static $classmap = array(
    );

    /**
     */
    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/formatter/namefieldformatter?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    public function formatNameField(FormatNameFieldArguments $parameters) {
        return $this->__soapCall('formatNameField', array($parameters));
    }

}
