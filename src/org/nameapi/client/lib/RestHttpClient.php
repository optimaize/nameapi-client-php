<?php

namespace org\nameapi\client\lib;

require_once(__DIR__.'/ApiException.php');
require_once(__DIR__.'/Configuration.php');
require_once(__DIR__.'/ObjectSerializer.php');

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
class RestHttpClient
{

    public static $PATCH = "PATCH";
    public static $POST = "POST";
    public static $GET = "GET";
    public static $HEAD = "HEAD";
    public static $OPTIONS = "OPTIONS";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    /**
     * Configuration
     * @var Configuration
     */
    protected $config;

    /**
     * Object Serializer
     * @var ObjectSerializer
     */
    protected $serializer;

    /**
     * Constructor of the class
     * @param Configuration $config config for this ApiClient
     */
    public function __construct(Configuration $config = null)
    {
        if ($config == null) {
            $config = Configuration::getDefaultConfiguration();
        }

        $this->config = $config;
        $this->serializer = new ObjectSerializer();
    }

    /**
     * @return ObjectSerializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    public function callApiGet($resourcePath, $queryParams, $headerParams, $responseType=null) {
        return $this->callApi($resourcePath, 'GET', $queryParams, null, $headerParams, $responseType);
    }

    /**
     * Make the HTTP call (Sync)
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headerParams parameters to be place in request header
     * @param string $responseType expected response type of the endpoint
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function callApi($resourcePath, $method, $queryParams, $postData, $headerParams, $responseType=null) {
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";

        if ($headerParams) {
            foreach ($headerParams as $key => $val) {
                $headers[] = "$key: $val";
            }
        }

        if ($postData && is_object($postData) or is_array($postData)) { // json model
            $postData = json_encode($this->serializer->sanitizeForSerialization($postData));
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

        if (!$queryParams) $queryParams = array();
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
            throw new ApiException('Method ' . $method . ' is not recognized.');
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

        // debug HTTP response body
        if ($this->config->getDebug()) {
            error_log("[DEBUG] HTTP Response body ~BEGIN~\n".print_r($http_body, true)."\n~END~\n", 3, $this->config->getDebugFile());
        }

        // Handle the response
        if ($response_info['http_code'] == 0) {
            throw new ApiException("API call to $url timed out: ".serialize($response_info), 0, null, null);
        } else if ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299 ) {
            // return raw body if response is a file
            if ($responseType == '\SplFileObject') {
                return array($http_body, $http_header);
            }

            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }
        } else {
            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }

            throw new ApiException(
                "[".$response_info['http_code']."] Error connecting to the API ($url)",
                $response_info['http_code'], $http_header, $data
            );
        }
        return array($data, $http_header);
    }

}
