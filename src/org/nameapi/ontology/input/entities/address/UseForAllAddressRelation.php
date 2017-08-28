<?php

namespace org\nameapi\ontology\input\entities\address;

require_once(__DIR__.'/AddressRelation.php');

/**
 * An address relation that specifies that the address is used for all purposes.
 *
 * <p>This is the case when only one address is known from the InputPerson.</p>
 */
class UseForAllAddressRelation extends AddressRelation {

    /**
     * @var InputAddress $address
     */
    public $address;


    /**
     * UseForAllAddressRelation constructor.
     * @param InputAddress $address
     */
    public function __construct(InputAddress $address) {
        $this->address = $address;
    }



    public function jsonSerialize() {
//        $x = array(
//            '@type' => "UseForAllAddressRelation",
//            'address' => $this->address,
//        );
//        var_dump($x);

        return array(
            'type' => "UseForAllAddressRelation",
            'address' => $this->address,
        );

//        $x = array(
//            '@type' => "UseForAllAddressRelation",
//            'address' => json_encode($this->address),
//        );
//        var_dump($x);

//        return array(
//            '@type' => "UseForAllAddressRelation",
//            'address' => json_encode($this->address),
//        );
    }

}

