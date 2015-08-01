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


class HLRResponseTest extends \PHPUnit_Framework_TestCase {

    private $login = 'rso';
    private $apiKey = 'afa1748a75c0d796079d681e25d271a2c7916327';
    private $apiHost = 'http://dev.sms16.ru/get/';

    public function test_makeHLRRequest(){
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost);
        $phone = array('79009009090', '79009008080');
        /*
         * || $phone = '79009009090,79009008080';
         */
        $result = $client->makeHLRRequest($phone);

        foreach ($result as $hlr) {
            $hlr->getId();
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
        }

        $this->assertInternalType('array',$result);
        $first = $result[0];
        $this->assertInstanceOf('Intis\SDK\Entity\HLRResponse',$first);
    }

    /**
     * @expectedException Intis\SDK\Exception\HLRResponseException
     */
    public function test_makeHLRRequestException(){
        $client = new IntisClient($this->login . '__r', $this->apiKey, $this->apiHost);
        $phone = array('79009009090', '79009008080');
        /*
         * || $phone = '79009009090,79009008080';
         */
        $result = $client->makeHLRRequest($phone);
    }
}
