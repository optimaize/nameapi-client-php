<?php

namespace Org\NameApi\Client\Services\Formatter\NameFieldFormatter;

use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Client\Services\Formatter\FormatterProperties;
use Org\NameApi\Client\Services\Formatter\FormatterResult;
use Org\NameApi\ontology\input\Context\Context;
use Org\NameApi\ontology\input\entities\person\Name\NameField;


/**
 *
 */
class NameFieldFormatterService extends BaseService
{

    private static $RESOURCE_PATH = "formatter/namefieldformatter";

    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NameField $nameField
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NameField $nameField, FormatterProperties $properties)
    {
        throw new \Exception("Method not implemented as of now.", 501);
    }

}
