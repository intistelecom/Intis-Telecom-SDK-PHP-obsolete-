<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 21:52
 */


namespace Intis\Test;

require  '../../../vendor/autoload.php';

use Intis\SDK\IntisClient;


class OriginatorsTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getOriginators(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $originators = $client->getOriginators();

        foreach($originators as $originator){
            $originator->getOriginator();
            $originator->getState();
        }

        $this->assertInternalType('array',$originators);
        $first = $originators[0];
        $this->assertInstanceOf('Intis\SDK\Entity\Originator',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\OriginatorException
     */
    public function test_getOriginatorsException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->getOriginators();
    }

    private function getData(){
        $result = '{"smstest":"completed","Stok&Sekond":"completed","chmvm":"completed","rsoTEST":"completed"}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
