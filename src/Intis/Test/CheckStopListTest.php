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


class CheckStopListTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_checkStopList(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = '79009009090';

        $stopList = $client->checkStopList($phone);
        $stopList->getId();
        $stopList->getDescription();
        $stopList->getTimeAddedAt();

        $this->assertInstanceOf('Intis\SDK\Entity\StopList',$stopList);
    }

    /**
     * @expectedException Intis\SDK\Exception\StopListException
     */
    public function test_checkStopListException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $phone = '79009009090';
        $client->checkStopList($phone);
    }
}
