<?php

namespace org\nameapi\client\http;

require_once(__DIR__.'/../fault/ServiceException.php');
require_once(__DIR__.'/RestHttpClientConfig.php');

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\fault\FaultInfo;
use org\nameapi\client\fault\FaultInfoUnmarshaller;
use org\nameapi\client\fault\Blame;
use org\nameapi\client\fault\Retry;
use org\nameapi\client\fault\HttpResponseData;


/**
 * Performs the HTTP actions.
 *
 * Uses and requires libcurl.
 * It would be nice to abstract the http away. The httplug project looks promising.
 *
 * Based on auto-generated code from https://github.com/swagger-api/swagger-codegen
 *
 * @category Class
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RestHttpClient {

    public static $PATCH = "PATCH";
    public static $POST = "POST";
    public static $GET = "GET";
    public static $HEAD = "HEAD";
    public static $OPTIONS = "OPTIONS";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    /**
     * @var RestHttpClientConfig
     */
    protected $config;


    /**
     * Constructor of the class
     * @param RestHttpClientConfig $config config for this ApiClient
     */
    public function __construct(RestHttpClientConfig $config = null) {
        if ($config == null) {
            $config = RestHttpClientConfig::getDefaultConfiguration();
        }

        $this->config = $config;
    }


    public function callApiGet($resourcePath, $queryParams, $headerParams) {
        return $this->callApi($resourcePath, 'GET', $queryParams, null, $headerParams);
    }
    public function callApiPost($resourcePath, $queryParams, $headerParams, $postData) {
        return $this->callApi($resourcePath, 'POST', $queryParams, $postData, $headerParams);
    }

    /**
     * Make the HTTP call (Sync)
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headerParams parameters to be place in request header
     * @throws ServiceException on a non 2xx response
     * @return mixed
     */
    public function callApi($resourcePath, $method, $queryParams, $postData, $headerParams) {
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";

        if (!empty($headerParams)) {
            foreach ($headerParams as $key => $val) {
                $headers[] = "$key: $val";
            }
        }

        if ($postData && is_object($postData) or is_array($postData)) { // json model
            $postData = json_encode($postData);
        }

        $url = $this->config->getBaseUrl() . $resourcePath;

        $curl = curl_init();
        // set timeout, if needed
        if ($this->config->getCurlTimeout() != 0) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->config->getCurlTimeout());
        }
        // return the result on success, rather than just TRUE
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // disable SSL verification, if needed
        if ($this->config->getSSLVerification() == false) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        if (is_null($queryParams)) $queryParams = array();
        $queryParams['apiKey'] = $this->config->getApiKey();
        $url = ($url . '?' . http_build_query($queryParams));

        if ($method == self::$POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$HEAD) {
            curl_setopt($curl, CURLOPT_NOBODY, true);
        } else if ($method == self::$OPTIONS) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "OPTIONS");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PATCH) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PUT) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$DELETE) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method != self::$GET) {
            $faultInfo = new FaultInfo(
                'BadRequest', new Blame('CLIENT'),
                'Method ' . $method . ' is not recognized.',
                1100, null,
                Retry::no(), Retry::no()
            );
            throw new ServiceException($faultInfo->getMessage(), $faultInfo, null);
        }
        if ($this->config->getDebug()) {
            error_log("[DEBUG] URL is $url", 3, $this->config->getDebugFile());
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        // Set user agent
        curl_setopt($curl, CURLOPT_USERAGENT, $this->config->getUserAgent());

        // debugging for curl
        if ($this->config->getDebug()) {
            error_log("[DEBUG] HTTP Request body  ~BEGIN~\n".print_r($postData, true)."\n~END~\n", 3, $this->config->getDebugFile());

            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            //this doesn't work, i get:
            //"curl_setopt(): cannot represent a stream of type Output as a STDIO FILE*"
//            curl_setopt($curl, CURLOPT_STDERR, fopen($this->config->getDebugFile(), 'a'));
        } else {
            curl_setopt($curl, CURLOPT_VERBOSE, 0);
        }

        // obtain the HTTP response headers
        curl_setopt($curl, CURLOPT_HEADER, 1);

        // Make the request
        $response = curl_exec($curl);
        $http_header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $http_header = substr($response, 0, $http_header_size);
        $http_body = substr($response, $http_header_size);
        $response_info = curl_getinfo($curl);
        $httpResponseData = new HttpResponseData($url, $response_info['http_code'], $http_body, $http_header);

        // debug HTTP response body
        if ($this->config->getDebug()) {
            error_log("[DEBUG] HTTP Response body ~BEGIN~\n".print_r($http_body, true)."\n~END~\n", 3, $this->config->getDebugFile());
        }

        // Handle the response
        if ($response_info['http_code'] == 0) {
            $faultInfo = new FaultInfo(
                'NetworkTimeout', new Blame('SERVER'),
                "API call to $url timed out: ".serialize($response_info),
                null, null,
                Retry::no(), Retry::no()
            );
            throw new ServiceException($faultInfo->getMessage(), $faultInfo, $httpResponseData);
        } else if ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299 ) {
            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }
        } else {
            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }

            $faultInfo = null;
            $msg = null;
            try {
                $faultInfo = FaultInfoUnmarshaller::unmarshallJsonObject($data);
                $msg = $faultInfo->getMessage();
            } catch (\Exception $e) {
                //TODO log.
                //I'm not throwing this because it would hide the original error.
                $msg = $e->getMessage();
            }
            throw new ServiceException($msg, $faultInfo, $httpResponseData);
        }
        return array($data, $httpResponseData);
    }



}
