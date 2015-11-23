<?php

namespace org\nameapi\client\fault;

/**
 * Tells if and when the service request can be tried again in case of a failure.
 */
class Retry
{

    public static function no() {
        return new Retry(new RetryType('NO'), null);
    }

    /**
     * @var RetryType
     */
    private $retryType;

    /**
     * @var int
     */
    private $retryInSeconds;

    /**
     * Retry constructor.
     * @param RetryType $retryType
     * @param int $retryInSeconds
     */
    public function __construct(RetryType $retryType, $retryInSeconds=null)
    {
        $this->retryType = $retryType;
        $this->retryInSeconds = $retryInSeconds;
    }

    /**
     * @return RetryType not null
     */
    public function getRetryType()
    {
        return $this->retryType;
    }

    /**
     * Tells when the service can be called again.
     * This is only available if <code>retryType</code> is LATER, and
     * can still be <code>null</code> if unknown.
     * @return int, or null if unspecified
     */
    public function getRetryInSeconds()
    {
        return $this->retryInSeconds;
    }


}