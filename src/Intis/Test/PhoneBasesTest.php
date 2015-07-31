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


class PhoneBasesTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_getPhoneBases(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phoneBases = $client->getPhoneBases();
        foreach($phoneBases as $oneBase){
            $oneBase->getBaseId();
            $oneBase->getTitle();
            $oneBase->getCount();
            $oneBase->getPages();

            $birthday = $oneBase->getBirthdayGreetingSettings();
            $birthday->getEnabled();
            $birthday->getDaysBefore();
            $birthday->getOriginator();
            $birthday->getTimeToSend();
            $birthday->getUseLocalTime();
            $birthday->getTemplate();
        }

        $this->assertInternalType('array',$phoneBases);
        $first = $phoneBases[0];
        $this->assertInstanceOf('Intis\SDK\Entity\PhoneBase',$first);
    }

    /**
     * @expectedException Intis\SDK\SDKException
     */
    public function test_getPhoneBasesException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $client->getPhoneBases();
    }
}
