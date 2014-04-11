<?php

namespace org\nameapi\client\services\parser\personnameparser\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__ . '/../../../BaseSoapClient.php');
require_once(__DIR__.'/ParseArguments.php');


/**
 * Use the PersonNameParser, this is wsdl internal only.
 */
class SoapPersonNameParserService extends BaseSoapClient {

    private static $classmap = array(
    );

    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/parser/personnameparser?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    /**
     * @param ParseArguments $parameters
     */
    public function parse(ParseArguments $parameters) {
        return $this->__soapCall('parse', array($parameters))->return;
    }

}
