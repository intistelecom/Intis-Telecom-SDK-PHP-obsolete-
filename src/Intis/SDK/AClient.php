<?php
namespace Intis\SDK;

use Intis\SDK\Exception\SDKException;
/**
 * Class AClient
 *
 * The main class for working with API
 *
 * @package Intis\SDK
 */
abstract class AClient {

    /**
     * @var string User´s login
     */
    protected $login;
    /**
     * @var string SDK key
     */
    protected $apiKey;
    /**
     * @var string SDK address
     */
    protected $apiHost;

    protected  $apiConnector;

    public function __construct(IApiConnector $apiConnector){
         $this->apiConnector = $apiConnector;
    }

    /**
     * Getting content using parameters and name of API script
     *
     * @param string $scriptName Name of API script
     * @param array $parameters[] array of parameters
     * 
     * @return \stdClass returns the data as an object
     */
    public function getContent($scriptName, $parameters = array()) {
        $all = $this->getParameters($parameters);

        $url = $this->apiHost . $scriptName . ".php?" . http_build_query($all);
        $result = $this->apiConnector->getContentFromApi($url);
        $this->checkException($result);

        return $result;
    }

    /**
     * Getting time in UNIX format from the file timestamp.php in API
     *
     * @return string
     */
    private function getTimestamp() {
        $url = $this->apiHost . 'timestamp.php';
        return $this->apiConnector->getTimestampFromApi($url);
    }

    /**
     * Getting basic API parameters 
     *
     * @return array
     */
    private function getBaseParameters() {
        return array(
            'login' => $this->login,
            'timestamp' => $this->getTimestamp(),
            'return' => 'json'
        );
    }

    /**
     * Getting additional parameters for API.
     * It creates an array with additional parameters and complements an array with a signature key.
     *
     * @param array $more
     * @return array
     */
    private function getParameters(array $more = array()) {
        $params = $this->getBaseParameters();
        if ($more) {
            foreach ($more as $key => $value) {
                $params[$key] = $value;
            }
        }
        $sig = $this->getSignature($params);
        $params['signature'] = $sig;

        return $params;
    }

    /**
     * Getting signatures by incoming parameters
     *
     * @param array $params array of parameters
     * @return string returns the signature line
     */
    private function getSignature($params) {
        ksort($params);
        reset($params);
        $str = implode('', $params) . $this->apiKey;

        return md5($str);
    }

    /**
     * Testing for special exceptions and error output
     *
     * @param bool|mixed|string $result API response
     * @throws SDKException
     */
    private function checkException($result) {
        if (!$result)
            throw new SDKException(0);

        if (isset($result->error))
            throw new SDKException($result->error);
    }

}
