<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2015
 * Time: 22:51
 */

namespace Intis\Test;

require  '../../../vendor/autoload.php';

use Intis\SDK\IntisClient;

class AddToStopListTest extends \PHPUnit_Framework_TestCase {
    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_addTemplate(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = '79009009090';

        $result = $client->addToStopList($phone);

        $this->assertNotEquals(0, $result);
    }

    /**
     * @expectedException Intis\SDK\Exception\AddToStopListException
     */
    public function test_addTemplateException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $phone = '79009009090';

        $result = $client->addToStopList($phone);
    }
}
