<?php

namespace Org\NameApi\Client\Services\Parser\PersonNameParser;

class ParserDispute
{

    /**
     * @var DisputeType $disputeType
     */
    private $disputeType = null;

    /**
     * @var string $message
     */
    private $message = null;

    /**
     * @param DisputeType $disputeType
     * @param string $message
     * @access public
     */
    public function __construct(DisputeType $disputeType, $message)
    {
        $this->disputeType = $disputeType;
        $this->message = $message;
    }

    /**
     * @return DisputeType
     */
    public function getDisputeType()
    {
        return $this->disputeType;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}
