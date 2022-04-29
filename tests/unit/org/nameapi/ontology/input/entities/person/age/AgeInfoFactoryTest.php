<?php

namespace Tests\Unit\Org\NameApi\Ontology\Input\Entities\Person\Age;

use Org\NameApi\Ontology\Input\Entities\Person\Age\AgeInfoFactory;
use PHPUnit\Framework\TestCase;

class AgeInfoFactoryTest extends TestCase
{

    public function testDate()
    {
        $ageInfo = AgeInfoFactory::forDate(1917, 5, 29);
        $this->assertEquals(29, $ageInfo->getDay());
        $this->assertEquals(5, $ageInfo->getMonth());
        $this->assertEquals(1917, $ageInfo->getYear());
    }

}
