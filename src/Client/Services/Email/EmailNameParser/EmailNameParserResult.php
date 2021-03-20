<?php

namespace Org\NameApi\Client\Services\Email\EmailNameParser;

class EmailNameParserResult
{

    /**
     * @var EmailAddressParsingResultType
     */
    private $resultType = null;

    /**
     * @var EmailNameParserMatch[] $matches
     */
    private $matches = null;


    /**
     * @param EmailAddressParsingResultType $resultType
     * @param EmailNameParserMatch[] $matches
     */
    public function __construct(EmailAddressParsingResultType $resultType, $matches)
    {
        $this->resultType = $resultType;
        $this->matches = $matches;
    }

    /**
     * @return EmailAddressParsingResultType
     */
    public function getResultType()
    {
        return $this->resultType;
    }

    /**
     * @return EmailNameParserMatch[]
     */
    public function getMatches()
    {
        return $this->matches;
    }


    public function __toString()
    {
        $ret = 'Result{';
        $ret .= 'type=' . $this->resultType;
        if (count($this->matches) > 0) {
            $ret .= ', matches=' . implode(", ", $this->matches);
        }
        return $ret . '}';
    }

}
