<?php

namespace org\nameapi\client\fault;

/**
 * An object containing HTTP data from the response.
 */
class HttpResponseData
{

    /**
     * @var string
     */
    private $url;
    /**
     * @var int
     */
    private $responseCode;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @var string
     */
    private $responseHeaders;

    /**
     * HttpInfo constructor.
     * @param string $url
     * @param int $responseCode
     * @param string $responseHeaders HTTP response header
     * @param string $responseBody HTTP body of the server response either as Json or string
     */
    public function __construct($url, $responseCode, $responseBody, $responseHeaders)
    {
        $this->url = $url;
        $this->responseCode = $responseCode;
        $this->responseBody = $responseBody;
        $this->responseHeaders = $responseHeaders;
    }


    /**
     * The remote address that was called.
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return string
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

}