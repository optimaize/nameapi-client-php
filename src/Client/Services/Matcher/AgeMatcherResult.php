<?php

namespace Org\NameApi\Client\Services\Matcher;

class AgeMatcherResult
{

    /**
     * @var AgeMatchType
     */
    private $matchType;

    function __construct($matchType)
    {
        $this->matchType = $matchType;
    }

    /**
     * @return AgeMatchType
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

}
