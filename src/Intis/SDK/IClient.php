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
use Intis\SDK\Entity\DailyStats;
use Intis\SDK\Entity\DeliveryStatus;
use Intis\SDK\Entity\HLRResponse;
use Intis\SDK\Entity\HLRStatItem;
use Intis\SDK\Entity\IncomingMessage;
use Intis\SDK\Entity\MessageSendingResult;
use Intis\SDK\Entity\Network;
use Intis\SDK\Entity\Originator;
use Intis\SDK\Entity\PhoneBase;
use Intis\SDK\Entity\PhoneBaseItem;
use Intis\SDK\Entity\StopList;
use Intis\SDK\Entity\Template;

/**
 * Interface IClient
 * Class with methods of receiving SDK information
 *
 * @package Intis\SDK
 */
interface IClient{
    
    /**
     * Getting user balance
     *
     * @return Balance
     */
    public function getBalance();
    
    /**
     * Getting user lists
     *
     * @return PhoneBase[]
     */
    public function getPhoneBases();
    
    /**
     * Getting user senders
     *
     * @return Originator[]
     */
    public function getOriginators();
    
    /**
     * Getting subscribers of list
     *
     * @param integer $baseId List ID
     * @param integer $page Page of list
     * 
     * @return PhoneBaseItem[]
     */
    public function getPhoneBaseItems($baseId, $page);
    
    /**
     * Getting message status
     *
     * @param int|int[] $messageId Message ID
     * 
     * @return DeliveryStatus[]
     */
    public function getDeliveryStatus($messageId);
    
    /**
     * SMS sending
     *
     * @param string|array $phone phone number(s)
     * @param string $originator sender name
     * @param string $text sms text
     * @param string $sendingTime an optional parameter, it is used when it is necessary to schedule SMS messages. Format YYYY-MM-DD HH:ii
     *
     * @return MessageSendingResult[]
     */
    public function sendMessage($phone, $originator, $text, $sendingTime = null);
    
    /**
     * Testing phone number for stop list
     *
     * @param string $phone Phone number
     * 
     * @return StopList
     */
    public function checkStopList($phone);
    
    /**
     * Adding number to stop list
     *
     * @param string $phone Phone number
     * 
     * @return integer
     */
    public function addToStopList($phone);
    
    /**
     * Getting user templates
     *
     * @return Template[]
     */
    public function getTemplates();
    
    /**
     * Adding user template
     *
     * @param string $title template name
     * @param string $template text of template
     * 
     * @return integer
     */
    public function addTemplate($title, $template);

    /**
     * Edit user template
     *
     * @param string $title template name
     * @param string $template text of template
     *
     * @return int|string
     */
    public function editTemplate($title, $template);

    /**
     * Getting statistics for the certain month
     *
     * @param string $year year
     * @param string $month month
     * 
     * @return DailyStats[]
     */
    public function getDailyStatsByMonth($year, $month);
    
    /**
     * Make an HLR request for number
     *
     * @param string|array $phone phone number(s)
     * 
     * @return HLRResponse[]
     */
    public function makeHLRRequest($phone);
    
    /**
     * Getting statuses of HLR request
     *
     * @param string $from
     * @param string $to
     * 
     * @return HLRStatItem[]
     */
    public function getHlrStats($from, $to);
    
    /**
     * Getting the operator of subscriber's phone number
     *
     * @param string $phone Phone number
     * 
     * @return Network
     */
    public function getNetworkByPhone($phone);
    
    /**
     * Getting incoming messages of certain date | for the period
     *
     * @param string $date date in the format YYYY-MM-DD | initial date in the format YYYY-MM-DD HH:II:SS
     * @param string $toDate finel date in the format YYYY-MM-DD HH:II:SS
     *
     * @return IncomingMessage[]
     */
    public function getIncomingMessages($date, $toDate);
}
