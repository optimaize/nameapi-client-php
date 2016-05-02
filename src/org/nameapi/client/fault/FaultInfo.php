<?php

namespace org\nameapi\client\fault;

require_once(__DIR__.'/Blame.php');
require_once(__DIR__.'/FaultInfo.php');
require_once(__DIR__.'/FaultInfoUnmarshaller.php');
require_once(__DIR__.'/Retry.php');
require_once(__DIR__.'/RetryType.php');
require_once(__DIR__.'/ServiceException.php');

/**
 * An object containing fault information that is used within a {@link ServiceException}.
 *
 * <p>It contains:
 * <ol>
 *   <li>{@link #blame} whether the server or the client is responsible</li>
 *   <li>{@link #applicationErrorCode} the reason for machines to understand</li>
 *   <li>{@link #message} the reason for humans to understand</li>
 *   <li>{@link #faultCause} exception class (technical detail)</li>
 *   <li>{@link #retrySameLocation} and {@link #retryOtherLocations} whether re-sending the same request makes sense</li>
 *   <li>{@link #incidentId} if it escalated for analysis by the service provider</li>
 * </ol>
 * </p>
 */
class FaultInfo
{

    /**
     * @var string
     */
    private $faultCause;

    /**
     * @var Blame
     */
    private $blame;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $applicationErrorCode;

    /**
     * @var string
     */
    private $incidentId;


    /**
     * @var Retry
     */
    private $retrySameLocation;

    /**
     * @var Retry
     */
    private $retryOtherLocations;

    /**
     * FaultInfo constructor.
     * @param string $faultCause
     * @param $blame
     * @param string $message
     * @param string $applicationErrorCode
     * @param string $incidentId
     * @param Retry $retrySameLocation
     * @param Retry $retryOtherLocations
     */
    public function __construct($faultCause, $blame, $message, $applicationErrorCode=null, $incidentId=null, Retry $retrySameLocation=null, Retry $retryOtherLocations=null)
    {
        $this->faultCause = $faultCause;
        $this->blame = $blame;
        $this->message = $message;
        $this->applicationErrorCode = $applicationErrorCode;
        $this->incidentId = $incidentId;
        $this->retrySameLocation = $retrySameLocation;
        $this->retryOtherLocations = $retryOtherLocations;
    }

    /**
     * Exception class type.
     *
     * <p>Examples:
     * <pre>
     * Caused by Client:
     *  - BadRequest
     *  - AccessDenied
     *  - Protocol
     * Caused by Server:
     *  - InternalServerError
     *  - ServiceTemporarilyUnavailable
     *  - BadResponse
     *
     * @return string
     */
    public function getFaultCause()
    {
        return $this->faultCause;
    }

    /**
     * @return mixed
     */
    public function getBlame()
    {
        return $this->blame;
    }

    /**
     * Exception message for the human to understand the problem.
     *
     * <p>
     * It can be generic or specific.
     * <pre>Examples:
     *  - "Account expired"
     *  - "Your account for user id 'foo' has expired on '2014-12-31'"
     * </pre></p>
     *
     * <p>It can be generic because either no detailed info is available, or because the system prefers to hide it
     * from the end user.</p>
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * An error code for machines to understand the problem.
     *
     * <p>It can be generic or specific.</p>
     *
     * @return string
     */
    public function getApplicationErrorCode()
    {
        return $this->applicationErrorCode;
    }

    /**
     * Tells if a server error was logged/reported/escalated for analyzing by a system admin, qa or programmer.
     *
     * @return string
     */
    public function getIncidentId()
    {
        return $this->incidentId;
    }

    /**
     * Tells if re-sending the same request that just failed with this error to the SAME NETWORK makes sense.
     * @return Retry, or null if unknown
     */
    public function getRetrySameLocation()
    {
        return $this->retrySameLocation;
    }

    /**
     * Tells if re-sending the same request that just failed with this error to ANOTHER NETWORK makes sense.
     * @return Retry, or null if unknown
     */
    public function getRetryOtherLocations()
    {
        return $this->retryOtherLocations;
    }

}