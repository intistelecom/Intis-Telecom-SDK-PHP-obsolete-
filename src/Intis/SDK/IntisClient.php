<?php

namespace Intis\SDK;

use Intis\SDK\Entity\Balance;
use Intis\SDK\Entity\Originator;
use Intis\SDK\Entity\PhoneBase;
use Intis\SDK\Entity\PhoneBaseItem;
use Intis\SDK\Entity\DeliveryStatus;
use Intis\SDK\Entity\StopList;
use Intis\SDK\Entity\MessageSendingResult;
use Intis\SDK\Entity\Template;
use Intis\SDK\Entity\DailyStats;
use Intis\SDK\Entity\Stats;
use Intis\SDK\Entity\HLRResponse;
use Intis\SDK\Entity\HLRStatItem;
use Intis\SDK\Entity\Network;
use Intis\SDK\Entity\IncomingMessage;


/**
 * Class IntisClient
 *
 * The main class for SMS sending and getting API information
 *
 * @package Intis\SDK
 */
class IntisClient extends AClient implements IClient {

    /**
     * Class constructor
     *
     * @param string $login user login
     * @param string $apiKey user API key
     * @param string $apiHost API address
     */
    public function __construct($login, $apiKey, $apiHost) {
        $this->login = $login;
        $this->apiKey = $apiKey;
        $this->apiHost = $apiHost;
    }

    /**
     * Getting user balance
     *
     * @return Balance
     */
    public function getBalance() {
        $content = $this->getContent('balance');

        $balance = new Balance($content);

        return $balance;
    }

    /**
     * Getting all user lists
     *
     * @return array
     */
    public function getPhoneBases() {
        $content = $this->getContent('base');

        $phoneBases = array();
        foreach ($content as $key => $bgs) {
            $phoneBases[] = new PhoneBase($key, $bgs);
        }

        return $phoneBases;
    }

    /**
     * Getting all user sender names
     *
     * @return array array of senders with its statuses
     */
    public function getOriginators() {
        $content = $this->getContent('senders');

        $originators = array();
        foreach ($content as $originator => $state) {
            $originators[] = new Originator($originator, $state);
        }

        return $originators;
    }

    /**
     * Getting subscribers of list 
     *
     * @param int $baseId List ID
     * @param int $page Page of list
     * @return array
     */
    public function getPhoneBaseItems($baseId, $page = 1) {
        $content = $this->getContent('phone', array('base' => $baseId, 'page' => $page));

        $items = array();
        foreach ($content as $phone => $item) {
            $items[] = new PhoneBaseItem($phone, $item);
        }

        return $items;
    }

    /**
     * Getting message status
     *
     * @param int $messageId Message ID
     * @return array
     */
    public function getDeliveryStatus($messageId) {
        if (!is_array($messageId))
            $messageId = array($messageId);
        $str = implode(',', $messageId);

        $content = $this->getContent('status', array('state' => $str));

        $deliveryStatus = array();
        foreach ($content as $messageId => $messageStatus) {
            $deliveryStatus[] = new DeliveryStatus($messageId, $messageStatus);
        }

        return $deliveryStatus;
    }

    /**
     * SMS sending
     *
     * @param array|string $phone phone number(s)
     * @param string $originator sender name
     * @param string $text sms text
     * @return array
     */
    public function sendMessage($phone, $originator, $text) {
        if (!is_array($phone))
            $phone = array($phone);
        $str = implode(',', $phone);

        $content = $this->getContent('send', array('phone' => $str, 'sender' => $originator, 'text' => $text));

        $messages = array();
        foreach ($content as $message) {
            $messages[] = new MessageSendingResult($message);
        }

        return $messages;
    }

    /**
     * Testing phone number for stop list
     *
     * @param string $phone phone number
     * @return StopList
     */
    public function checkStopList($phone) {
        $content = $this->getContent('find_on_stop', array('phone' => $phone));

        $stopList = new StopList($content);

        return $stopList;
    }

    /**
     * Adding number to stop list
     *
     * @param string $phone phone number
     * @return mixed
     */
    public function addToStopList($phone) {
        $content = $this->getContent('add2stop', array('phone' => $phone));

        return $content->id;
    }

    /**
     * Getting user templates
     *
     * @return array
     */
    public function getTemplates() {
        $content = $this->getContent('template');

        $templates = array();
        foreach ($content as $title => $template) {
            $templates[] = new Template($title, $template);
        }

        return $templates;
    }

    /**
     * Adding user template
     *
     * @param string $title template name
     * @param string $template text of template
     * @return mixed
     */
    public function addTemplate($title, $template) {
        $content = $this->getContent('add_template', array('name' => $title, 'text' => $template));

        return $content->id;
    }

    /**
     * Getting statistics for the certain month
     *
     * @param string $year year
     * @param string $month month
     * @return array
     */
    public function getDailyStatsByMonth($year, $month) {
        $date = date("Y-m", mktime(0, 0, 0, $month, 1, $year));

        $content = $this->getContent('stat_by_month', array('month' => $date));

        $dailyStats = array();
        foreach ($content as $row1) {
            $stats = array();
            foreach ($row1 as $day => $one) {
                foreach ($one as $row2) {
                    foreach ($row2 as $state => $values) {
                        foreach ($values as $value) {
                            $stats[] = new Stats($state, $value);
                        }
                    }
                }

                $dailyStats[] = new DailyStats($day, $stats);
            }
        }

        return $dailyStats;
    }

    /**
     * Sending HLR request for number
     *
     * @param array|string $phone phone number
     * @return array
     */
    public function makeHLRRequest($phone) {
        if (!is_array($phone))
            $phone = array($phone);
        $str = implode(',', $phone);

        $content = $this->getContent('hlr', array('phone' => $str));

        $hlr = array();
        foreach ($content as $one) {
            $hlr[] = new HLRResponse($one);
        }
        return $hlr;
    }

    /**
     * Getting statuses of HLR request
     *
     * @param string $from
     * @param string $to
     * @return array
     */
    public function getHlrStats($from, $to) {
        $content = $this->getContent('hlr_stat', array('from' => $from, 'to' => $to));

        $stats = array();
        foreach ($content as $phone => $one) {
            $stats[] = new HLRStatItem($phone, $one);
        }

        return $stats;
    }

    /**
     * Getting the operator of subscriber phone number
     *
     * @param string $phone phone number
     * @return Network
     */
    public function getNetworkByPhone($phone) {
        $content = $this->getContent('operator', array('phone' => $phone));

        $network = new Network($content);

        return $network;
    }

    /**
     * Getting incoming messages of certain date
     *
     * @param string $date date
     * @return array
     */
    public function getIncomingMessages($date) {
        $content = $this->getContent('incoming', array('date' => $date));

        $messages = array();
        foreach ($content as $key => $one) {
            $messages[] = new IncomingMessage($key, $one);
        }

        return $messages;
    }
}
