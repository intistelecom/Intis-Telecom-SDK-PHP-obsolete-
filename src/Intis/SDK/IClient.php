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
     * @return Intis\SDK\Entity\Balance
     */
    function getBalance();
    
    /**
     * Getting user lists
     *
     * @return Intis\SDK\Entity\PhoneBase[]
     */
    function getPhoneBases();
    
    /**
     * Getting user senders
     *
     * @return Intis\SDK\Entity\Originator[]
     */
    function getOriginators();
    
    /**
     * Getting subscribers of list
     *
     * @param integer $baseId List ID
     * @param integer $page Page of list
     * 
     * @return Intis\SDK\Entity\PhoneBaseItem[]
     */
    function getPhoneBaseItems($baseId, $page);
    
    /**
     * Getting message status
     *
     * @param integer $messageId Message ID
     * 
     * @return Intis\SDK\Entity\DeliveryStatus[]
     */
    function getDeliveryStatus($messageId);
    
    /**
     * SMS sending
     *
     * @param string|array $phone phone number(s)
     * @param string $originator sender name
     * @param string $text sms text
     * 
     * @return Intis\SDK\Entity\MessageSendingResult[]
     */
    function sendMessage($phone, $originator, $text);
    
    /**
     * Testing phone number for stop list
     *
     * @param string $phone Phone number
     * 
     * @return Intis\SDK\Entity\StopList
     */
    function checkStopList($phone);
    
    /**
     * Adding number to stop list
     *
     * @param string $phone Phone number
     * 
     * @return integer
     */
    function addToStopList($phone);
    
    /**
     * Getting user templates
     *
     * @return Intis\SDK\Entity\Template[]
     */
    function getTemplates();
    
    /**
     * Adding user template
     *
     * @param string $title template name
     * @param string $template text of template
     * 
     * @return integer
     */
    function addTemplate($title, $template);
    
    /**
     * Getting statistics for the certain month
     *
     * @param string $year year
     * @param string $month month
     * 
     * @return Intis\SDK\Entity\DailyStats[]
     */
    function getDailyStatsByMonth($year, $month);
    
    /**
     * Make an HLR request for number
     *
     * @param string|array $phone phone number(s)
     * 
     * @return Intis\SDK\Entity\HLRResponse[]
     */
    function makeHLRRequest($phone);
    
    /**
     * Getting statuses of HLR request
     *
     * @param string $from
     * @param string $to
     * 
     * @return Intis\SDK\Entity\HLRStatItem[]
     */
    function getHlrStats($from, $to);
    
    /**
     * Getting the operator of subscriber's phone number
     *
     * @param string $phone Phone number
     * 
     * @return Intis\SDK\Entity\Network
     */
    function getNetworkByPhone($phone);
    
    /**
     * Getting incoming messages of certain date
     *
     * @param string $date date
     * 
     * @return Intis\SDK\Entity\IncomingMessage[]
     */
    function getIncomingMessages($date);
}
