<?php

namespace org\nameapi\client\services;


/**
 * Encapsulates the protocol, host name and port number in one object.
 */
class Host {

    /**
     * Default is 'http'.
     * Can be 'https' if you were given SSL access.
     */
    private $protocol;

    /**
     * Default is 'api.nameapi.org'.
     * You really only need to change this if you want to target another api version (like a development version
     * or a release candidate).
     */
    private $hostName;

    /**
     * Default is 80 for http and 443 for https, you should not need to ever modify it.
     */
    private $portNumber;

    public static function standard() {
        return new Host('http', 'api.nameapi.org', 80);
    }
    public static function http($hostName) {
        return new Host('http', $hostName, 80);
    }
    public static function https($hostName) {
        return new Host('https', $hostName, 443);
    }


    /**
     * Constructor
     */
    public function __construct($protocol, $hostName, $portNumber) {
        $this->protocol = $protocol;
        $this->hostName = $hostName;
        $this->portNumber = $portNumber;
    }

    /**
     * Returns something like 'http://api.nameapi.org' and omits the port if it's a default port (like 80 for http).
     */
    public function toString() {
        $str = $this->protocol . '://' . $this->hostName;
        if ($this->protocol==='http' && $this->portNumber==80) {
            //don't add port
        } else if ($this->protocol==='https' && $this->portNumber==443) {
            //don't add port
        } else {
            $str .= ':'. $this->portNumber;
        }
        return $str;
    }

} 