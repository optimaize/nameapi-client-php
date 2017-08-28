<?php

namespace org\nameapi\client\services\riskdetector;

require_once(__DIR__ . '/RiskType.php');

/**
 * Classification of disguise risks.
 *
 * <p>Such mangled input is used to circumvent machine processing.</p>
 *
 * <p>Humans can still understand these modified values, but machines can't unless they detect the patterns and clean
 * the input.</p>
 *
 * Possible values are are listed here.
 *
 *
 * PADDING
 * Padding is adding content to the left/right of a value.
 * Example: XXXJohnXXX
 *
 *
 * STUTTER_TYPING
 * Example: Petttttttttterson
 *
 *
 * SPACED_TYPING
 * Example: P e t e r   M i l l e r
 *
 *
 * OTHER
 * Everything that does not fit into any of the other categories.
 * Individual categories may be created in the future.
 * Currently here goes:
 *  - Leetspeak (using numbers instead of letters): l33t spe4k
 *  - Crossing fields (moving a part into the next field): ["Danie", "lJohnson"]
 *    This often happens unintentionally.
 *  - Writing out numbers where digits are expected, for example in house numbers.
 *    For example "twentyseven" instead of "27".
 *  - Using visually identical or similar letters with different Unicode values.
 *    Mixing scripts: For example mixing the Cyrillic with the Latin alphabet. Cyrillic has visually identical letters.
 *    Same script: For example using the lower case L for an upper case i (l vs I) and vice versa, using a zero 0 for an oh O.
 *
 */
final class DisguiseRiskType extends RiskType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='PADDING' && $value!=='STUTTER_TYPING' && $value!=='SPACED_TYPING' && $value!=='OTHER') {
            throw new \Exception('Invalid value for DisguiseRiskType: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

