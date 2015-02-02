<?php

namespace org\nameapi\client\services\matcher\personmatcher\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__ . '/../../../BaseSoapClient.php');
require_once(__DIR__.'/MatchArguments.php');


/**
 * Use the PersonNameParser, this is wsdl internal only.
 */
class SoapPersonMatcherService extends BaseSoapClient {

    private static $classmap = array(
    );

    public function __construct(array $options = array(), $baseUrl) {
        parent::__construct($baseUrl.'matcher/personmatcher?wsdl', self::$classmap, $options);
    }

    /**
     * @param MatchArguments $parameters
     * @access public
     * @return matchResponse
     */
    public function match(MatchArguments $parameters) {
        return $this->__soapCall('match', array($parameters))->return;
    }

}

