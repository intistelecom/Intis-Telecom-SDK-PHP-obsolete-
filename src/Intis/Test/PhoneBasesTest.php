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
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getPhoneBases(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
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
     * @expectedException Intis\SDK\Exception\PhoneBaseException
     */
    public function test_getPhoneBasesException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $client->getPhoneBases();
    }

    private function getData(){
        $result = '{"125480":{"name":"989878979","time_birth":"12:00:00","day_before":"0","local_time":"1","birth_sender":"","birth_text":"","on_birth":"0","count":"0","pages":0},'.
            '"125473":{"name":"654564","time_birth":"12:00:00","day_before":"0","local_time":"1","birth_sender":"","birth_text":"","on_birth":"0","count":"367","pages":4}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
