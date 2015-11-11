<?php

namespace org\nameapi\client\services;


spl_autoload_register();

require_once(__DIR__.'/../../../../../../src/org/nameapi/client/services/ServiceFactory.php');
require_once(__DIR__.'/../../../../../../src/org/nameapi/client/services/Host.php');

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;
use org\nameapi\ontology\input\context\TextCase;


abstract class BaseServiceTest extends \PHPUnit_Framework_TestCase {

    private $apiKey = null;

    /**
     * @return Context
     */
    protected function makeContext() {
        if (!$this->apiKey) {
            die("Put your api key in the \$apiKey variable to run these functional tests!");
        }
        return Context::builder()
            ->priority(Priority::REALTIME())
            ->textCase(TextCase::TITLE_CASE())
            ->build();
    }

    /**
     * @return ServiceFactory
     */
    protected function makeServiceFactory() {
        //this is what you usually want, for production:
        return new ServiceFactory($this->apiKey, $this->makeContext(), Host::standard(), '4.0');
    }

}
