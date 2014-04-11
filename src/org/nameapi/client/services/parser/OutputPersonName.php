<?php

namespace org\nameapi\client\services\parser;

require_once(__DIR__.'/Term.php');

class OutputPersonName {

    /**
     *
     * @var Term[] $terms
     * @access public
     */
    public $terms = null;

    /**
     * @param Term[] $terms
     */
    public function __construct(array $terms) {
        $this->terms = $terms;
    }

    /**
     * @return Term[]
     */
    public function getTerms() {
        return $this->terms;
    }

    /**
     * Returns all terms that have the given term type, or empty array if none.
     * @param string $termType
     * @return Term[]
     */
    public function getAll($termType) {
        $arr = array();
        foreach ($this->terms as $term) {
            if ((string)$term->getTermType() === $termType) {
                array_push($arr, $term);
            }
        }
        return $arr;
    }

    /**
     * Returns the first term that has the given term type, or null if none.
     * @param string $termType
     * @return Term
     */
    public function getFirst($termType) {
        foreach ($this->terms as $term) {
            if ((string)$term->getTermType() === $termType) {
                return $term;
            }
        }
        return null;
    }


    public function __toString() {
        $nameStr = '';
        foreach ($this->terms as $term) {
            if ($nameStr != '') $nameStr .= ',';
            $nameStr .= $term;
        }
        $str = 'OutputPersonName{terms='.$nameStr.'}';
        return $str;
    }

    public function toShortString() {
        $nameStr = '';
        foreach ($this->terms as $term) {
            if ($nameStr != '') $nameStr .= ', ';
            $nameStr .= $term->toShortString();
        }
        return $nameStr;
    }
}
