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


class TemplatesTest extends \PHPUnit_Framework_TestCase{
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_getTemplates(){
        $connector = new LocalApiConnector($this->getData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $templates = $client->getTemplates();

        foreach ($templates as $template) {
            $template->getId();
            $template->getTitle();
            $template->getTemplate();
            $template->getCreatedAt();
        }

        $this->assertInternalType('array', $templates);
        $first = $templates[0];
        $this->assertInstanceOf('Intis\SDK\Entity\Template', $first);
    }

    /**
     * @expectedException Intis\SDK\Exception\TemplateException
     */
    public function test_getTemplatesException(){
        $connector = new LocalApiConnector($this->getErrorData());
        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $client->getTemplates();
    }

    private function getData()
    {
        $result = '{"25583":{"name":"newtemplate","template":"Hello! #first-name# #last-name#! Your amount is #note1#","up_time":"2015-03-31 15:22:50"},"25586":{"name":"test1","template":"template for test1","up_time":"2015-07-29 15:37:47"},"25582":{"name":"vnb cv","template":"test","up_time":"2015-03-30 17:34:39"}}';
        return json_decode($result);
    }

    private function getErrorData()
    {
        $result = '{"error":4}';
        return json_decode($result);
    }
}
