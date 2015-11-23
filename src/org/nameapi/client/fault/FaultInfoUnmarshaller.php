<?php

namespace org\nameapi\client\fault;

require_once(__DIR__.'/FaultInfo.php');
require_once(__DIR__.'/Blame.php');
require_once(__DIR__.'/Retry.php');
require_once(__DIR__.'/RetryType.php');


/**
 * Converts json to a FaultInfo.
 */
class FaultInfoUnmarshaller
{



    /**
     * @param $data The json string
     * @return FaultInfo
     * @throws \Exception
     */
    public static function unmarshallJsonString($data) {
        try {
            return FaultInfoUnmarshaller::unmarshallJsonObject(json_decode($data));
        } catch (\Exception $e) {
            throw new \Exception("Failed unmarshalling json object into FaultInfo!", 0, $e);
        }
    }


    /**
     * @param $data The json object you got from json_decode("json string")
     * @return FaultInfo
     * @throws \Exception
     */
    public static function unmarshallJsonObject($data) {
        try {
            $retrySame = null;
            if (isSet($data->retrySameLocation)) {
                $retrySame = FaultInfoUnmarshaller::unmarshallRetry($data->retrySameLocation);
            }

            $retryOther = null;
            if (isSet($data->retryOtherLocations)) {
                $retryOther = FaultInfoUnmarshaller::unmarshallRetry($data->retryOtherLocations);
            }

            return new FaultInfo(
                $data->faultCause,
                new Blame($data->blame),
                $data->message,
                (isSet($data->applicationErrorCode)) ? $data->applicationErrorCode : null, //this is optional
                (isSet($data->incidentId)) ? $data->incidentId : null, //this is optional
                $retrySame, $retryOther
            );

            //httpStatusCode\":401,\"httpStatusMeaning\":\"Unauthorized\"}"

        } catch (\Exception $e) {
            throw new \Exception("Failed unmarshalling json object into FaultInfo!", 0, $e);
        }
    }

    /**
     * @param $data
     * @return Retry
     * @throws \Exception
     */
    private static function unmarshallRetry($data)
    {
        return new Retry(
            new RetryType($data->retryType),
            (isSet($data->retryInSeconds)) ? $data->retryInSeconds : null // this is optional
        );
    }

}