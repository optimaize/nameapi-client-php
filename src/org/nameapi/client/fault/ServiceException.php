<?php

namespace org\nameapi\client\fault;

require_once(__DIR__.'/Blame.php');
require_once(__DIR__.'/Retry.php');
require_once(__DIR__.'/RetryType.php');
require_once(__DIR__.'/../http/HttpResponseData.php');

use \Exception;

/**
 * This Exception, or a subtype of it, is thrown in case something did not go as planned.
 */
class ServiceException extends Exception {

    /**
     * @var FaultInfo
     */
    private $faultInfo;

    /**
     * @var HttpResponseData
     */
    private $httpData;


    /**
     * Constructor
     * @param string $message
     * @param FaultInfo faultInfo
     * @param HttpResponseData $httpData
     * @param Exception $cause
     */
    public function __construct($message, FaultInfo $faultInfo=null, HttpResponseData $httpData=null, $cause=null) {
        parent::__construct($message, 0, $cause);
        $this->faultInfo = $faultInfo;
        $this->httpData = $httpData;
    }



    /**
     * @return FaultInfo or null if not available, for example because un-serializing failed
     */
    public function getFaultInfo()
    {
        return $this->faultInfo;
    }

    /**
     * @return HttpResponseData or null if not available, for example because the error occurred before even hitting the web,
     *         or because a timeout occurred.
     */
    public function getHttpData()
    {
        return $this->httpData;
    }

}
