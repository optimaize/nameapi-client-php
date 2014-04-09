<?php

namespace org\nameapi\client\services\system\ping\wsdl;

use org\nameapi\client\commonwsdl\PriceArguments;
use org\nameapi\client\commonwsdl\PriceResponse;
use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__.'/../../../Util.php');
require_once('PingArguments.php');
require_once('PingResponse.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 *
 */
class SoapPingerService extends BaseSoapClient {

    private static $classmap = array(
        'pinger'        => 'org\nameapi\client\services\system\ping\wsdl\PingArguments',
        'pingResponse'  => 'org\nameapi\client\services\system\ping\wsdl\PingResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/system/pinger?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    /**
     * @param PriceArguments $parameters
     * @return PriceResponse
     */
    public function price(PriceArguments $parameters) {
        return $this->__soapCall('price', array($parameters));
    }

    /**
     * @param PingArguments $parameters
     * @return PingResponse
     */
    public function ping(PingArguments $parameters) {
        return $this->__soapCall('pinger', array($parameters));
    }

}