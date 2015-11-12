<?php

namespace org\nameapi\client\services\email\emailnameparser;


/**
 * Class EmailAddressParsingResultType2
 *
 * Possible values are:
 *
 * FUNCTIONAL
 * The email address belongs to a department (eg accounting@example.com) or is
 * technical (eg hostmaster@example.com).
 *
 * INITIALS
 * The email address contains a person's initials such as ab@example.com.
 * <p>Note that this answer is a guess, the 2 letters could also have another meaning
 * such as a short given name or surname, or something completely different.</p>
 *
 * PERSON_NAME
 * The email address contains a person's name such as john.doe@example.com.
 *
 * PSEUDONYM
 * The email address uses a pseudonym as the user name such as maverick1986@example.com or happyhippo@example.com.
 *
 * NOT_A_NAME
 * There is no name in the address, for example x2000@example.com
 * <p>The address may be personal or non-personal, can't say (as in UNKNOWN)
 * but it is clear that no name can be found in it.</p>
 *
 * UNKNOWN
 * The email address could not be classified and hence the service failed to extract a name.
 *
 *
 */
final class EmailAddressParsingResultType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='FUNCTIONAL'
            && $value!=='INITIALS'
            && $value!=='PERSON_NAME'
            && $value!=='PSEUDONYM'
            && $value!=='NOT_A_NAME'
            && $value!=='UNKNOWN'
        ) {
            throw new \Exception('Invalid value for EmailAddressParsingResultType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}

