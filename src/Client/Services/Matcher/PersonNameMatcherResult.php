<?php

namespace Org\NameApi\Client\Services\Matcher;

class PersonNameMatcherResult
{

    /**
     * @var PersonNameMatchType $type
     */
    private $matchType = null;

    /**
     * @param PersonNameMatchType $type
     */
    public function __construct(PersonNameMatchType $type)
    {
        $this->matchType = $type;
    }

    /**
     *
     * @return PersonNameMatchType
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

}
