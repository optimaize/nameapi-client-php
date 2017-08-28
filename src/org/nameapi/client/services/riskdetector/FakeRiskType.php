<?php

namespace org\nameapi\client\services\riskdetector;

require_once(__DIR__ . '/RiskType.php');

/**
 * Classification of risks.
 *
 * <p>In some situations the exact classification is difficult.
 * For example a person's name may be from fiction, but also be famous at the same time.</p>
 *
 *
 * Possible values are are listed here.
 *
 *
 * RANDOM_TYPING
 * This kind of input is often used to quickly pass mandatory fields in a form.
 * Example: "asdf asdf".
 *
 *
 * PLACEHOLDER
 * Examples:
 * For person name: "John Doe".
 * For person title: Example: "King Peter"
 *            The given name field doesn't contain a given name, but has at least a title.
 *            It may, in addition, contain a salutation.
 * For salutation: Example: "Mr. Smith" (Mr. in the given name field).
 *                 The given name field doesn't contain a given name, but has a salutation.
 *                 There is no title in it, otherwise PLACEHOLDER_TITLE would be used.
 * For place name: "Anytown"
 *
 *
 * FICTIONAL
 * Examples:
 * For natural person: "James Bond".
 * For legal person: ACME (American Company Making Everything)
 * For place: "Atlantis", "Entenhausen"
 *
 *
 * FAMOUS
 * Examples:
 * For natural person: "Barak Obama".
 *
 *
 * HUMOROUS
 * For natural person: "Sandy Beach".
 * Place example: "Timbuckthree"
 *
 *
 * INVALID
 * This includes multiple types of invalid form input.
 * Refusing input:
 * Example: "None of your business"
 * Placeholder nouns: "Someone", "Somebody else", "Somewhere", "Nowhere"
 * Repeating the form fields:
 * Example for person name: "firstname lastname"
 * Examples for street: "Street"
 * Vulgar language, swearing
 * Examples: "fuck off"
 *
 *
 * STRING_SIMILARITY
 * The given name and surname field are equal or almost equal, or match a certain pattern.
 * Example: "John" / "John"
 * The risk score is culture adjusted. In some cultures such names do exist, however, a risk is still raised.
 *
 *
 * OTHER
 * Everything that does not fit into any of the other categories.
 *
 */
final class FakeRiskType extends RiskType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='RANDOM_TYPING' && $value!=='PLACEHOLDER' && $value!=='FICTIONAL' && $value!=='FAMOUS' && $value!=='HUMOROUS' && $value!=='INVALID' && $value!=='OTHER') {
            throw new \Exception('Invalid value for FakeRiskType: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

