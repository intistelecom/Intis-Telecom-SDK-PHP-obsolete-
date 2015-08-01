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


class HLRStatItemTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_makeHLRRequest(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $from = '2014-07-01';
        $to = '2015-03-01';
        $result = $client->getHlrStats($from, $to);

        foreach($result as $hlr){
            $hlr->getId();
            $hlr->getPhone();
            $hlr->getMessageId();
            $hlr->getTotalPrice();
            $hlr->getDestination();
            $hlr->getIMSI();
            $hlr->getMCC();
            $hlr->getMNC();
            $hlr->getOriginalCountryCode();
            $hlr->getOriginalCountryName();
            $hlr->getOriginalNetworkName();
            $hlr->getOriginalNetworkPrefix();
            $hlr->getPortedCountryName();
            $hlr->getPortedCountryPrefix();
            $hlr->getPortedNetworkName();
            $hlr->getPortedNetworkPrefix();
            $hlr->getRoamingCountryName();
            $hlr->getRoamingCountryPrefix();
            $hlr->getRoamingNetworkName();
            $hlr->getRoamingNetworkPrefix();
            $hlr->getStatus();
            $hlr->getPricePerMessage();
            $hlr->isInRoaming();
            $hlr->isPorted();
            $hlr->getRequestId();
            $hlr->getRequestTime();
        }

        $this->assertInternalType('array',$result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\HLRResponse',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\HLRStatItemException
     */
    public function test_makeHLRRequestException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $from = '2014-07-01';
        $to = '2015-03-01';
        $client->getHlrStats($from, $to);
    }
}
