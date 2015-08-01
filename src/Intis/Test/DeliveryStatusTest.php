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

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getDeliveryStatus(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);

        $messageId = array('4334273170107609330007');

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
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $messageId = array('4381960011347047370003');

        $client->getDeliveryStatus($messageId);
    }
}
