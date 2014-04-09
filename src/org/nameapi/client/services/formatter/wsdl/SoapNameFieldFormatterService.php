<?php

namespace org\nameapi\client\services\formatter\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__ . '/../../Util.php');
require_once('FormatNameFieldArguments.php');
require_once('SoapFormatterProperties.php');
require_once(__DIR__ . '/../../BaseSoapClient.php');


/**
 * Use the NameFieldFormatterService, this is wsdl internal only.
 */
class SoapNameFieldFormatterService extends BaseSoapClient {

    private static $classmap = array(
    );

    /**
     */
    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/formatter/namefield?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    /**
     * @param FormatNameFieldArguments $parameters
     * @access public
     */
    public function formatNameField(FormatNameFieldArguments $parameters) {
        return $this->__soapCall('formatNameField', array($parameters));
    }

}
