<?php

namespace org\nameapi\client\services\riskdetector\riskdetector;

require_once(__DIR__ . '/../RiskDetectorResult.php');

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\riskdetector\RiskDetectorResult;
use org\nameapi\client\services\riskdetector\DetectedRisk;
use org\nameapi\client\services\riskdetector\DisguiseRiskType;
use org\nameapi\client\services\riskdetector\FakeRiskType;
use org\nameapi\client\services\riskdetector\DataItem;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/riskdetector/person
 *
 * HOW TO USE:
 * $riskDetector = $myServiceFactory->riskServices()->personRiskDetector();
 * $riskResult = $riskDetector->detect($myInputPerson);
 *
 * @since v5.3
 */
class PersonRiskDetectorService extends BaseService {

    private static $RESOURCE_PATH = "riskdetector/person";


    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @return RiskDetectorResult
     * @throws ServiceException
     */
    public function detect(NaturalInputPerson $person) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonRiskDetectorService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson'=>$person, 'context'=>$this->context)
        );

        try {
            $score = $response->score;
            $risks = array();
            foreach ($response->risks as $risk) {
                $risk = new DetectedRisk(
                    new DataItem($risk->dataItem),
                    $this->_riskTypeToEnum2($risk->riskType),
                    $risk->riskScore,
                    $this->_riskReason($risk)
                );
                array_push($risks, $risk);
            }
            return new RiskDetectorResult($score, $risks);
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

    /**
     * The object structure changed in version 5.3. This doesn't work anymore.
     * @throws \Exception
     */
    private function _riskTypeToEnum($val) {
        if ($val[0] === 'FakeRiskType') {
            return new FakeRiskType($val[1]);
        } else if ($val[0] === 'DisguiseRiskType') {
            return new DisguiseRiskType($val[1]);
        } else {
            throw new \Exception("Unsupported risk class: ".$val[0]);
        }
    }

    private function _riskTypeToEnum2($val) {
        if ($val === 'RANDOM_TYPING' || $val === 'PLACEHOLDER' || $val === 'FICTIONAL' || $val === 'FAMOUS' ||
            $val === 'HUMOROUS' || $val === 'INVALID' || $val === 'STRING_SIMILARITY' || $val === 'OTHER') {
            return new FakeRiskType($val);
        } else if ($val === 'PADDING' || $val === 'STUTTER_TYPING' || $val === 'SPACED_TYPING') {
            return new DisguiseRiskType($val);
        } else {
            throw new \Exception("Unsupported risk type: ".$val);
        }
    }

    private function _riskReason($val) {
        if (isset($val->reason)) {
            return $val->reason;
        } else {
            //(temporary fallback)
            return "(no reason specified)";
        }
    }

}
