<?php

namespace org\nameapi\client\services;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/system/SystemServiceFactory.php');
require_once(__DIR__.'/parser/ParserServiceFactory.php');
require_once(__DIR__.'/genderizer/GenderizerServiceFactory.php');
require_once(__DIR__.'/matcher/MatcherServiceFactory.php');
require_once(__DIR__.'/formatter/FormatterServiceFactory.php');
require_once(__DIR__.'/email/EmailServiceFactory.php');

require_once(__DIR__.'/../commonwsdl/exception/FaultBean.php');
require_once(__DIR__.'/../commonwsdl/PriceArguments.php');
require_once(__DIR__.'/../commonwsdl/PriceResponse.php');

require_once(__DIR__.'/../../ontology/input/context/Context.php');
require_once(__DIR__.'/../../ontology/input/entities/contact/EmailAddressFactory.php');
require_once(__DIR__.'/../../ontology/input/entities/contact/TelNumberFactory.php');
require_once(__DIR__.'/../../ontology/input/entities/person/NaturalInputPersonBuilder.php');



/**
 *
 */
class ServiceFactory {

    private $context;
    private $systemServiceFactory;
    private $parserServiceFactory;
    private $genderizerServiceFactory;
    private $matcherServiceFactory;
    private $formatterServiceFactory;
    private $emailServiceFactory;


    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }


    /**
     * @return system\SystemServiceFactory
     */
    public function systemServices() {
        if ($this->systemServiceFactory==null) {
            $this->systemServiceFactory = new system\SystemServiceFactory($this->context);
        }
        return $this->systemServiceFactory;
    }

    /**
     * @return parser\ParserServiceFactory
     */
    public function parserServices() {
        if ($this->parserServiceFactory==null) {
            $this->parserServiceFactory = new parser\ParserServiceFactory($this->context);
        }
        return $this->parserServiceFactory;
    }

    /**
     * @return genderizer\GenderizerServiceFactory
     */
    public function genderizerServices() {
        if ($this->genderizerServiceFactory==null) {
            $this->genderizerServiceFactory = new genderizer\GenderizerServiceFactory($this->context);
        }
        return $this->genderizerServiceFactory;
    }

    /**
     * @return matcher\MatcherServiceFactory
     */
    public function matcherServices() {
        if ($this->matcherServiceFactory==null) {
            $this->matcherServiceFactory = new matcher\MatcherServiceFactory($this->context);
        }
        return $this->matcherServiceFactory;
    }

    /**
     * @return formatter\FormatterServiceFactory
     */
    public function formatterServices() {
        if ($this->formatterServiceFactory==null) {
            $this->formatterServiceFactory = new formatter\FormatterServiceFactory($this->context);
        }
        return $this->formatterServiceFactory;
    }

    /**
     * @return email\EmailServiceFactory
     */
    public function emailServices() {
        if ($this->emailServiceFactory==null) {
            $this->emailServiceFactory = new email\EmailServiceFactory($this->context);
        }
        return $this->emailServiceFactory;
    }


    public static $classmap = array(
        'soapContext' => 'org\nameapi\ontology\input\context\Context',

        'faultBean'    => 'org\nameapi\client\commonwsdl\exception\FaultBean',

        'price'         => 'org\nameapi\client\commonwsdl\PriceArguments',
        'priceResponse' => 'org\nameapi\client\commonwsdl\PriceResponse',

        'soapSimpleNaturalPerson'  => '\org\nameapi\ontology\input\entities\person\NaturalInputPerson',
        'soapPersonName'           => '\org\nameapi\ontology\input\entities\person\name\InputPersonName',
        'soapFieldOrTypeBasedTerm' => '\org\nameapi\ontology\input\entities\person\name\NameField',
        'soapAgeInfo'              => '\org\nameapi\ontology\input\entities\person\age\AgeInfo',
        //'soapAddressRelation'      => '\org\nameapi\soapAddressRelation',
        //'soapAddress'              => '\org\nameapi\soapAddress',
        //'soapStreetInfo'           => '\org\nameapi\soapStreetInfo',
        'soapEmailAddress'         => '\org\nameapi\ontology\input\entities\contact\EmailAddress',
        'soapTelNumber'            => '\org\nameapi\ontology\input\entities\contact\TelNumber',

//    'properties'    => '\org\nameapi\properties',
//    'entry'         => '\org\nameapi\entry',
    );

}
