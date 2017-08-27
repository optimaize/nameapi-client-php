<?php

namespace org\nameapi\client\services\riskdetector;

require_once(__DIR__ . '/DataItem.php');
require_once(__DIR__ . '/DisguiseRiskType.php');
require_once(__DIR__ . '/FakeRiskType.php');

/**
 * One detected risk within a RiskDetectorResult.
 * There can be 0-n of such risks in one result.
 *
 * @since v5.3
 */
class DetectedRisk {

    /**
     * @var DataItem $dataItem
     */
    private $dataItem = null;

    /**
     * @var RiskType $riskType
     */
    private $riskType = null;

    /**
     * @var double $riskScore
     */
    private $riskScore = null;

    /**
     * @var string $reason
     */
    private $reason = null;


    /**
     */
    public function __construct($dataItem, $riskType, $riskScore, $reason) {
        if ($riskScore <= 0 || $riskScore > 1) throw new \Exception("Risk score is out of range (0,1]: ".$riskScore."!");
        $this->dataItem = $dataItem;
        $this->riskType = $riskType;
        $this->riskScore = $riskScore;
        $this->reason = $reason;
    }


    /**
     * @return DataItem
     */
    public function getDataItem() {
        return $this->dataItem;
    }

    /**
     * @return RiskType
     */
    public function getRiskType() {
        return $this->riskType;
    }

    /**
     * @return float range (0,1] the higher the worse.
     */
    public function getRiskScore() {
        return $this->riskScore;
    }

    /**
     * A one sentence text reason intended for the human that explains the risk.
     */
    public function getReason() {
        return $this->reason;
    }

}

