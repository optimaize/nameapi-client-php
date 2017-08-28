<?php

namespace org\nameapi\client\services\riskdetector;


/**
 * Class DataItem
 *
 * Possible values are are listed here.
 *
 *
 * NAME
 * The person's name (given name, surname, business name ...).
 *
 *
 * ADDRESS
 * The person's address (domicile, delivery address, ...).
 *
 *
 * AGE
 * for natural people it's the birth date
 * for legal people it's the founding time.
 *
 *
 * EMAIL
 * An email address.
 *
 *
 * TEL
 * Includes telephone numbers, fax numbers, mobile phone numbers etc.
 *
 */
final class DataItem {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='NAME' && $value!=='ADDRESS' && $value!=='AGE' && $value!=='EMAIL' && $value!=='TEL') {
            throw new \Exception('Invalid value for DataItem: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

