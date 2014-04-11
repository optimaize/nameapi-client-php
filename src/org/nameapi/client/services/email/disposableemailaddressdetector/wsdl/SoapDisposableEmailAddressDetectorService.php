<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector\wsdl;

use org\nameapi\client\services\BaseSoapClient;

require_once(__DIR__ . '/../../../Util.php');
require_once('DisposableEmailAddressDetectorArguments.php');
require_once(__DIR__ . '/../../../BaseSoapClient.php');


/**
 * Use the DisposableEmailAddressDetector, this is wsdl internal only.
 */
class SoapDisposableEmailAddressDetectorService extends BaseSoapClient {

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
        'disposableEmailAddressDetectorArguments'  => 'org\nameapi\client\services\email\disposableemailaddressdetector\wsdl\DisposableEmailAddressDetectorArguments',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://api.nameapi.org/soap/v4.0/email/disposableemailaddressdetector?wsdl') {
        parent::__construct($wsdl, self::$classmap, $options);
    }

    /**
     *
     * @param DisposableEmailAddressDetectorArguments $parameters
     * @access public
     * @return DisposableEmailAddressDetectorResponse
     */
    public function isDisposable(DisposableEmailAddressDetectorArguments $parameters) {
        return $this->__soapCall('isDisposable', array($parameters));
    }

}
