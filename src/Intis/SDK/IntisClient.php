<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Intis Telecom
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Intis\SDK;

use Intis\SDK\Entity\Balance;
use Intis\SDK\Entity\MessageSendingResult;
use Intis\SDK\Entity\Originator;
use Intis\SDK\Entity\PhoneBase;
use Intis\SDK\Entity\PhoneBaseItem;
use Intis\SDK\Entity\DeliveryStatus;
use Intis\SDK\Entity\StopList;
use Intis\SDK\Entity\MessageSending;
use Intis\SDK\Entity\MessageSendingSuccess;
use Intis\SDK\Entity\MessageSendingError;
use Intis\SDK\Entity\Template;
use Intis\SDK\Entity\DailyStats;
use Intis\SDK\Entity\Stats;
use Intis\SDK\Entity\HLRResponse;
use Intis\SDK\Entity\HLRStatItem;
use Intis\SDK\Entity\Network;
use Intis\SDK\Entity\IncomingMessage;
use Intis\SDK\Exception\AddTemplateException;
use Intis\SDK\Exception\AddToStopListException;
use Intis\SDK\Exception\BalanceException;
use Intis\SDK\Exception\DailyStatsException;
use Intis\SDK\Exception\DeliveryStatusException;
use Intis\SDK\Exception\HLRResponseException;
use Intis\SDK\Exception\HLRStatItemException;
use Intis\SDK\Exception\IncomingMessageException;
use Intis\SDK\Exception\MessageSendingResultException;
use Intis\SDK\Exception\NetworkException;
use Intis\SDK\Exception\OriginatorException;
use Intis\SDK\Exception\PhoneBaseException;
use Intis\SDK\Exception\PhoneBaseItemException;
use Intis\SDK\Exception\StopListException;
use Intis\SDK\Exception\TemplateException;

/**
 * Class IntisClient
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
     * @param IApiConnector $apiConnector
     */
    public function __construct($login, $apiKey, $apiHost, IApiConnector $apiConnector = null) {
        if($apiConnector)
            parent::__construct($apiConnector);
        else
            parent::__construct(new HttpApiConnector());
        $this->login = $login;
        $this->apiKey = $apiKey;
        $this->apiHost = rtrim($apiHost, '/') . '/';
    }

    /**
     * Getting user balance
     *
     * @throws BalanceException
     * @return Balance
     */
    public function getBalance() {
        try {
            $content = $this->getContent('balance');
            $balance = new Balance($content);

            return $balance;
        }
        catch(\Exception $e){
            throw new BalanceException($e->getCode());
        }
    }

    /**
     * Getting all user lists
     *
     * @throws PhoneBaseException
     * @return PhoneBase[]
     */
    public function getPhoneBases() {
        try {
            $content = $this->getContent('base');

            $phoneBases = array();
            foreach ($content as $key => $bgs) {
                $phoneBases[] = new PhoneBase($key, $bgs);
            }

            return $phoneBases;
        }
        catch(\Exception $e){
            throw new PhoneBaseException($e->getCode());
        }
    }

    /**
     * Getting all user sender names
     *
     * @throws OriginatorException
     * @return Originator[] array of senders with its statuses
     */
    public function getOriginators() {
        try {
            $content = $this->getContent('senders');

            $originators = array();
            foreach ($content as $originator => $state) {
                $originators[] = new Originator($originator, $state);
            }

            return $originators;
        }
        catch(\Exception $e){
            throw new OriginatorException($e->getCode());
        }
    }

    /**
     * Getting subscribers of list 
     *
     * @param int $baseId List ID
     * @param int $page Page of list
     *
     * @throws PhoneBaseItemException
     * @return PhoneBaseItem[]
     */
    public function getPhoneBaseItems($baseId, $page = 1) {
        try {
            $content = $this->getContent('phone', array('base' => $baseId, 'page' => $page));

            $items = array();
            foreach ($content as $phone => $item) {
                $items[] = new PhoneBaseItem($phone, $item);
            }

            return $items;
        }
        catch(\Exception $e){
            throw new PhoneBaseItemException($e->getCode());
        }
    }

    /**
     * Getting message status
     *
     * @param int $messageId Message ID
     *
     * @throws DeliveryStatusException
     * @return DeliveryStatus[]
     */
    public function getDeliveryStatus($messageId) {
        try {
            if (!is_array($messageId))
                $messageId = array($messageId);
            $str = implode(',', $messageId);

            $content = $this->getContent('status', array('state' => $str));

            $deliveryStatus = array();
            foreach ($content as $id => $messageStatus) {
                $deliveryStatus[] = new DeliveryStatus($id, $messageStatus);
            }

            return $deliveryStatus;
        }
        catch(\Exception $e){
            throw new DeliveryStatusException($e->getCode());
        }
    }

    /**
     * SMS sending
     *
     * @param array|string $phone phone number(s)
     * @param string $originator sender name
     * @param string $text sms text
     *
     * @throws MessageSendingResultException
     * @return MessageSendingResult[]
     */
    public function sendMessage($phone, $originator, $text) {
        try {
            if (!is_array($phone))
                $phone = array($phone);
            $str = implode(',', $phone);

            $content = $this->getContent('send', array('phone' => $str, 'sender' => $originator, 'text' => $text));

            $messages = array();
            foreach ($content as $phoneResult => $message) {
                $result = new MessageSending($phoneResult, $message);
                if($result->getError() == 0){
                    $success = new MessageSendingSuccess();
                    $success->setPhone($result->getPhone());
                    $success->setMessageId($result->getMessageId());
                    $success->setMessagesCount($result->getMessagesCount());
                    $success->setCost($result->getCost());
                    $success->setCurrency($result->getCurrency());

                    $messages[] = $success;
                }
                else{
                    $error = new MessageSendingError();
                    $error->setPhone($result->getPhone());
                    $error->setCode($result->getError());

                    $messages[] = $error;
                }
            }

            return $messages;
        }
        catch(\Exception $e){
            throw new MessageSendingResultException($e->getCode());
        }
    }

    /**
     * Testing phone number for stop list
     *
     * @param string $phone phone number
     *
     * @throws StopListException
     * @return StopList
     */
    public function checkStopList($phone) {
        try {
            $content = $this->getContent('find_on_stop', array('phone' => $phone));

            $stopList = new StopList($content);

            return $stopList;
        }
        catch(\Exception $e){
            throw new StopListException($e->getCode());
        }
    }

    /**
     * Adding number to stop list
     *
     * @param string $phone phone number
     *
     * @throws AddToStopListException
     * @return int|string
     */
    public function addToStopList($phone) {
        try {
            $content = $this->getContent('add2stop', array('phone' => $phone));

            return $content->id;
        }
        catch(\Exception $e){
            throw new AddToStopListException($e->getCode());
        }
    }

    /**
     * Getting user templates
     *
     * @throws TemplateException
     * @return Template[]
     */
    public function getTemplates() {
        try {
            $content = $this->getContent('template');

            $templates = array();
            foreach ($content as $title => $template) {
                $templates[] = new Template($title, $template);
            }

            return $templates;
        }
        catch(\Exception $e){
            throw new TemplateException($e->getCode());
        }
    }

    /**
     * Adding user template
     *
     * @param string $title template name
     * @param string $template text of template
     *
     * @throws AddTemplateException
     * @return int|string
     */
    public function addTemplate($title, $template) {
        try {
            $content = $this->getContent('add_template', array('name' => $title, 'text' => $template));

            return $content->id;
        }
        catch(\Exception $e){
            throw new AddTemplateException($e->getCode());
        }
    }

    /**
     * Getting statistics for the certain month
     *
     * @param string $year year
     * @param string $month month
     *
     * @throws DailyStatsException
     * @return Stats[]
     */
    public function getDailyStatsByMonth($year, $month) {
        try {
            $date = date("Y-m", mktime(0, 0, 0, $month, 1, $year));

            $content = $this->getContent('stat_by_month', array('month' => $date));

            $dailyStats = array();
            foreach ($content as $row1) {
                $stats = array();
                foreach ($row1->stats as $one) {
                    $stats[] = new Stats($one);
                }

                $dailyStats[] = new DailyStats($row1->date, $stats);
            }

            return $dailyStats;
        }
        catch(\Exception $e){
            throw new DailyStatsException($e->getCode());
        }
    }

    /**
     * Sending HLR request for number
     *
     * @param array|string $phone phone number
     *
     * @throws HLRResponseException
     * @return HLRResponse[]
     */
    public function makeHLRRequest($phone){
        try {
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
        catch(\Exception $e){
            throw new HLRResponseException($e->getCode());
        }
    }

    /**
     * Getting statuses of HLR request
     *
     * @param string $from
     * @param string $to
     *
     * @throws HLRStatItemException
     * @return HLRStatItem[]
     */
    public function getHlrStats($from, $to) {
        try {
            $content = $this->getContent('hlr_stat', array('from' => $from, 'to' => $to));
            $stats = array();
            foreach ($content as $phone => $one) {
                $stats[] = new HLRStatItem($phone, $one);
            }

            return $stats;
        }
        catch(\Exception $e){
            throw new HLRStatItemException($e->getCode());
        }
    }

    /**
     * Getting the operator of subscriber phone number
     *
     * @param string $phone phone number
     *
     * @throws NetworkException
     * @return Network
     */
    public function getNetworkByPhone($phone) {
        try {
            $content = $this->getContent('operator', array('phone' => $phone));

            $network = new Network($content);

            return $network;
        }
        catch(\Exception $e){
            throw new NetworkException($e->getCode());
        }
    }

    /**
     * Getting incoming messages of certain date
     *
     * @param string $date date
     *
     * @throws IncomingMessageException
     * @return IncomingMessage[]
     */
    public function getIncomingMessages($date) {
        try {
            $content = $this->getContent('incoming', array('date' => $date));

            $messages = array();
            foreach ($content as $key => $one) {
                $messages[] = new IncomingMessage($key, $one);
            }

            return $messages;
        }
        catch(\Exception $e){
            throw new IncomingMessageException($e->getCode());
        }
    }
}
