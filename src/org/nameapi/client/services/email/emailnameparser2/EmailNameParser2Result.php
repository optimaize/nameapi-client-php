<?php

namespace org\nameapi\client\services\email\emailnameparser2;

use org\nameapi\client\services\email\emailnameparser\EmailNameParserMatch;

require_once(__DIR__.'/EmailAddressParsingResultType2.php');
require_once(__DIR__.'/../emailnameparser/EmailNameParserMatch.php');

class EmailNameParser2Result {

    /**
     * @var EmailAddressParsingResultType2
     */
    private $resultType = null;

    /**
     * @var EmailNameParserMatch[] $matches
     */
    private $matches = null;


    /**
     * @param EmailAddressParsingResultType2 $resultType
     * @param EmailNameParserMatch[] $matches
     */
    public function __construct(EmailAddressParsingResultType2 $resultType, $matches) {
        $this->resultType = $resultType;
        $this->matches = $matches;
    }

    /**
     * @return EmailAddressParsingResultType2
     */
    public function getResultType() {
        return $this->resultType;
    }

    /**
     * @return EmailNameParserMatch[]
     */
    public function getMatches() {
        return $this->matches;
    }


    public function __toString() {
        $ret  = 'Result{';
        $ret .= 'type='.$this->resultType;
        if (count($this->matches) >0) {
            $ret .= ', matches='. implode(", ",$this->matches);
        }
        return $ret.'}';
    }

} 