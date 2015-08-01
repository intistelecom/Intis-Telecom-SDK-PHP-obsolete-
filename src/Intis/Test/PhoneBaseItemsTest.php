<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 21:52
 */


namespace Intis\Test;

require_once  __DIR__.'/../../../vendor/autoload.php';

use Intis\SDK\IntisClient;


class PhoneBaseItemsTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getPhoneBaseItems(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);

        $baseId = 125508;
        $page = 1;
        $items = $client->getPhoneBaseItems($baseId, $page);

        foreach($items as $item){
            $item->getPhone();
            $item->getFirstName();
            $item->getMiddleName();
            $item->getLastName();
            $item->getGender();
            $item->getNetwork();
            $item->getArea();
            $item->getNote1();
            $item->getNote2();
        }

        $this->assertInternalType('array',$items);
        $first = $items[0];
        $this->assertInstanceOf('Intis\SDK\Entity\PhoneBaseItem',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\PhoneBaseItemException
     */
    public function test_getPhoneBaseItemsException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);

        $baseId = 12547233333;
        $page = 1;
        $client->getPhoneBaseItems($baseId, $page);
    }
}
