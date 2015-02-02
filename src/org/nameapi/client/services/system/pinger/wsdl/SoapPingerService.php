<?php

namespace org\nameapi\client\services\system\ping\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/PingArguments.php');
require_once(__DIR__.'/PingResponse.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 *
 */
class SoapPingerService extends BaseSoapClient {

    private static $classmap = array(
        'ping'          => 'org\nameapi\client\services\system\ping\wsdl\PingArguments',
        'pingResponse'  => 'org\nameapi\client\services\system\ping\wsdl\PingResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $baseUrl) {
        parent::__construct($baseUrl.'system/pinger?wsdl', self::$classmap, $options);
    }


    /**
     * @param PingArguments $parameters
     * @return PingResponse
     */
    public function ping(PingArguments $parameters) {
        return $this->__soapCall('ping', array($parameters));
    }

}
