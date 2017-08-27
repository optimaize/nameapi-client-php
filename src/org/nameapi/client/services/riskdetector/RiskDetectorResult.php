<?php

namespace org\nameapi\client\services\riskdetector;

require_once(__DIR__ . '/DetectedRisk.php');

/**
 * The result of a risk detector execution.
 *
 * @since v5.3
 */
class RiskDetectorResult {

    /**
     * @var double $score
     */
    private $score = null;

    /**
     * @var DetectedRisk[] $risks
     */
    private $risks = null;

    /**
     */
    public function __construct($score, $risks) {
        if ($score < -1 || $score > 1) throw new \Exception("Score is out of range [-1,1]: ".$score);
        if ($score > 0) {
            if (sizeof($risks)==0) throw new \Exception("At least one risk is required when there is a positive score!");
        }
        $this->score = $score;
        $this->risks = $risks;
    }


    /**
     * An overall score considering all the detected risks and all the positive attributes of the record.
     *
     * Range [-1,0) means no risks were detected and the record looks good.
     * 0 means no risks were detected, but also no positive attributes were found, the service can't tell for sure.
     * Range (0,1] means one or multiple  risks were detected.
     *
     * @return double in range [-1,1]
     */
    public function getScore() {
        return $this->score;
    }

    public function hasRisk() {
        return !empty($this->risks);
    }

    /**
     * Returns all the detected risks.
     * @return DetectedRisk[] Sorted by severity having the worst come first. Possibly empty, guaranteed to be non-empty if the getScore() is > 0.
     */
    public function getRisks() {
        return $this->risks;
    }

}

