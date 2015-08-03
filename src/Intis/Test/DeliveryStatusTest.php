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


class DeliveryStatusTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getDeliveryStatus(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $messageId = array('4385937961543210880001', '4385937961543210880002');

        $deliveryStatus = $client->getDeliveryStatus($messageId);

        foreach($deliveryStatus as $message){
            $message->getMessageId();
            $message->getMessageStatus();
            $message->getCreatedAt();
        }

        $this->assertInternalType('array',$deliveryStatus);
        $first = $deliveryStatus[0];
        $this->assertInstanceOf('Intis\SDK\Entity\DeliveryStatus',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\DeliveryStatusException
     */
    public function test_getDeliveryStatusException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $messageId = array('4385937961543210880001', '4385937961543210880002');

        $client->getDeliveryStatus($messageId);
    }

    private function getData(){
        $result = '{"4385937961543210880001":{"status":"deliver", "time":"2014-10-05"},"4385937961543210880002":{"status":"not_deliver", "time":"2014-10-01"}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
