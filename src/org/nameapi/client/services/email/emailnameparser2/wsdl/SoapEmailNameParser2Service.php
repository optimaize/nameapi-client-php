<?php

namespace org\nameapi\client\services\email\emailnameparser2\wsdl;

use org\nameapi\client\services\BaseSoapClient;
use org\nameapi\client\services\email\emailnameparser\wsdl\EmailNameParserServiceArguments;

require_once(__DIR__.'/../../emailnameparser/wsdl/EmailNameParserServiceArguments.php');
require_once(__DIR__. '/../../../BaseSoapClient.php');


/**
 * Use the EmailNameParserService, this is wsdl internal only.
 */
class SoapEmailNameParser2Service extends BaseSoapClient {

    private static $classmap = array();

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $baseUrl) {
        parent::__construct($baseUrl.'email/emailnameparser2?wsdl', self::$classmap, $options);
    }


    /**
     * @param EmailNameParserServiceArguments $parameters
     */
    public function parse(EmailNameParserServiceArguments $parameters) {
        return $this->__soapCall('parse', array($parameters));
    }

}
