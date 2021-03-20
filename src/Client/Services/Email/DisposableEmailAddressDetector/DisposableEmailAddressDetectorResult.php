<?php

namespace Org\NameApi\Client\Services\Email\DisposableEmailAddressDetector;

class DisposableEmailAddressDetectorResult
{

    /**
     * @var Maybe $disposable
     */
    private $disposable = null;

    /**
     * @param Maybe $disposable
     * @access public
     */
    public function __construct($disposable)
    {
        $this->disposable = $disposable;
    }

    /**
     * @return Maybe
     */
    public function getDisposable()
    {
        return $this->disposable;
    }

}
