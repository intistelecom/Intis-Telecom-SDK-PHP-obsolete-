Intis-Telecom-SDK-PHP
=====================

The Intis telecom gateway lets you send SMS messages worldwide via its API. This program sends HTTP(s) requests and receives information as a response in JSON and/or XML. The main functions of our API include:

* sending SMS messages (including scheduling options);
* receiving status reports about messages that have been sent previously;
* requesting lists of authorised sender names;
* requesting lists of incoming SMS messages;
* requesting current balance status;
* requesting lists of databases;
* requesting lists of numbers within particular contact list;
* searching for a particular number in a stop list;
* requesting lists of templates;
* adding new templates;
* requesting monthly statistics;
* making HLR request;
* HLR запрос
* receiving HLR request statistics;
* requesting an operator’s name by phone number;

To begin using our API please [apply](https://go.intistele.com/external/client/register/) for your account at our website where you can get your login and API key.

Install
---------------------------
```bash
composer require "intis/sdk: dev-master"
```

Usage
---------------------------

class IntisClient - The main class for SMS sending and getting API information

There are three mandatory parameters that you have to provide the constructor in order to initialize. They are:
* $login - user login
* $apiKey - user API key
* $apiHost - API address

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Intis\SDK\IntisClient;

$client = new IntisClient($login, $apiKey, $apiHost);
```

This class includes the following methods:
--------------------------------

Use the `getBalance()` method to request your balance status
```php
$balance = $client->getBalance();

$amount = $balance->getAmount();     // Getting amount of money
$currency = $balance->getCurrency(); // Getting name of currency
```

To get a list of all the contact databases you have use the function `getPhoneBases()`
```php
$phoneBases = $client->getPhoneBases();

foreach($phoneBases as $oneBase){
    $oneBase->getBaseId();                               // Getting list ID
    $oneBase->getTitle();                                // Getting list name
    $oneBase->getCount();                                // Getting number of contacts in list
    $oneBase->getPages();                                // Getting number of pages in list

    $birthday = $oneBase->getBirthdayGreetingSettings(); // Getting settings of birthday greetings
    $birthday->getEnabled();                             // Getting key that is responsible for sending greetings, 0 - do not send, 1 - send
    $birthday->getDaysBefore();                          // Getting the number of days to send greetings before
    $birthday->getOriginator();                          // Getting name of sender for greeting SMS
    $birthday->getTimeToSend();                          // Getting time for sending greetings. All SMS will be sent at this time.
    $birthday->getUseLocalTime();                        // Getting variable that indicates using of local time while SMS sending.
    $birthday->getTemplate();                            // Getting text template that will be used in the messages
}
```

Our gateway supports the option of having unlimited sender’s names. To see a list of all senders’ names use the method `getOriginators()`
```php
$originators = $client->getOriginators();

foreach($originators as $originator){
    $originator->getOriginator(); // Getting sender name
    $originator->getState();      // Getting sender status
}
```

To get a list of phone numbers from a certain contact list you need the `getPhoneBaseItems($baseId, $page)` method. For your convenience, the entire list is split into separate pages.
The parameters are: `$baseId` - the ID of a particular database (mandator), and `$page` - a page number in a particular database (optional).
```php
$items = $client->getPhoneBaseItems($baseId, $page);

foreach($items as $item){
    $item->getPhone();      // Getting subscriber number
    $item->getFirstName();  // Getting subscriber first name
    $item->getMiddleName(); // Getting subscriber middle name
    $item->getLastName();   // Getting subscriber last name
    $item->getBirthDay();   // Getting subscriber birthday
    $item->getGender();     // Getting gender of subscriber
    $item->getNetwork();    // Getting operator of subscriber
    $item->getArea();       // Getting region of subscriber
    $item->getNote1();      // Getting subscriber note 1
    $item->getNote2();      // Getting subscriber note 2
}
```

To receive status info for an SMS you have already sent, use the function `getDeliveryStatus($messageId)` where `$messageId` - is an array of sent message IDs.
```php
$deliveryStatus = $client->getDeliveryStatus($messageId);

foreach($deliveryStatus as $message){
    $message->getMessageId();     // Getting message ID
    $message->getMessageStatus(); // Getting a message status
    $message->getCreatedAt();     // Getting a time of message
}
```

To send a message (to one or several recipients), use the function `sendMessage($phone, $originator, $text)`,
where `$phone` - is a set of numbers you send your messages to,
`$originator` is a sender’s name and `$text` stands for the content of the message.
An array includes `MessageSendingSuccess` if the message was successfully sent or `MessageSendingError` in case of failure.
```php
$messages = $client->sendMessage($phone, $originator, $text);

foreach($messages as $one){
    if($one->isOk()) {            // A flag of successful dispatch of a message
        $one->getPhone();         // Getting phone number
        $one->getMessageId();     // Getting message ID
        $one->getCost();          // Getting price for message
        $one->getCurrency();      // Getting name of currency
        $one->getMessagesCount(); // Getting number of message parts
    }
    else{
        $one->getPhone();         // Getting phone number
        $one->getMessage();       // Getting error message
        $one->getCode();          // Getting code error in SMS sending
    }

}
```

To add a number to a stoplist run `addToStopList($phone)` where `$phone` is an individual phone number
```php
$id = $client->addToStopList($phone); // return ID in stop list
```

To check if a particular phone number is listed within a stop list use the function `checkStopList($phone)`, where `$phone` is an individual phone number.
```php
$stopList = $client->checkStopList($phone);

$stopList->getId();          // Getting ID in stop list
$stopList->getDescription(); // Getting reason of adding to stop list
$stopList->getTimeAddedAt(); // Getting time of adding to stop list
```

Our gateway supports the option of creating multiple templates of SMS messages. To get a list of templates use the function `getTemplates()`.
As a response you will get a list of all the messages that a certain login has set up.
```php
$templates = $client->getTemplates();

foreach ($templates as $template) {
    $template->getId();        // Getting template ID
    $template->getTitle();     // Getting template name
    $template->getTemplate();  // Getting text of template
    $template->getCreatedAt(); // Getting the date and time when a particular template was created
}
```
To add a new template to a system run the function `addTemplate($title, $template)` where `$title` is a name of a template, and `$template` is the text content of a template
```php
$templteId = $client->addTemplate($title, $text); // return ID user template
```

To get stats about messages you have sent during a particular month use the function `getDailyStatsByMonth($year, $month)` where `$year` and `$month` - are the particular date you need statistics for.
```php
$result = $client->getDailyStatsByMonth($year, $month);

foreach($result as $one){
    $one->getDay();            // Getting day of month

    $stats = $one->getStats(); // Getting daily statistics
    foreach($stats as $i){
        $i->getState();        // Getting status of message
        $i->getCost();         // Getting prices of message
        $i->getCurrency();     // Getting name of currency
        $i->getCount();        // Getting number of message parts
    }
}
```

HLR (Home Location Register) - is the centralised databas that provides detailed information regarding the GSM mobile network of every mobile user.
HLR requests let you check the availability of a single phone number or a list of numbers for further clean up of unavailable numbers from a contact list.
To perform an HLR request, our system supports the function `makeHLRRequest($phone)` where `$phone` is the array of phone numbers.
```php
$result = $client->makeHLRRequest($phone);

foreach ($result as $hlr) {
    $hlr->getId();                    // Getting ID
    $hlr->getDestination();           // Getting recipient
    $hlr->getIMSI();                  // Getting IMSI
    $hlr->getMCC();                   // Getting MCC of subscriber
    $hlr->getMNC();                   // Getting MNC of subscriber
    $hlr->getOriginalCountryName();   // Getting the original name of the subscriber's country
    $hlr->getOriginalCountryCode();   // Getting the original code of the subscriber's country
    $hlr->getOriginalNetworkName();   // Getting the original name of the subscriber's operator
    $hlr->getOriginalNetworkPrefix(); // Getting the original prefix of the subscriber's operator
    $hlr->getPortedCountryName();     // Getting name of country if subscriber's phone number is ported
    $hlr->getPortedCountryPrefix();   // Getting prefix of country if subscriber's phone number is ported
    $hlr->getPortedNetworkName();     // Getting name of operator if subscriber's phone number is ported
    $hlr->getPortedNetworkPrefix();   // Getting prefix of operator if subscriber's phone number is ported
    $hlr->getRoamingCountryName();    // Getting name of country if the subscriber is in roaming
    $hlr->getRoamingCountryPrefix();  // Getting prefix of country if the subscriber is in roaming
    $hlr->getRoamingNetworkName();    // Getting name of operator if the subscriber is in roaming
    $hlr->getRoamingNetworkPrefix();  // Getting prefix of operator if the subscriber is in roaming
    $hlr->getStatus();                // Getting status of subscriber
    $hlr->getPricePerMessage();       // Getting price for message
    $hlr->isInRoaming();              // Determining if the subscriber is in roaming
    $hlr->isPorted();                 // Identification of ported number
}
```
Besides, you can can get HLR requests statistics regarding a certain time range. To do that,  use the function `getHlrStats($from, $to)` where `$from` and `$to` are the beginning and end of a time period.
```php
$result = $client->getHlrStats($from, $to);

foreach($result as $hlr){
        $hlr->getId();                    // Getting ID
        $hlr->getPhone();                 // Getting phone number
        $hlr->getMessageId();             // Getting message ID
        $hlr->getTotalPrice();            // Getting final price of request
        $hlr->getDestination();           // Getting recipient
        $hlr->getIMSI();                  // Getting IMSI
        $hlr->getMCC();                   // Getting MCC of subscriber
        $hlr->getMNC();                   // Getting MNC of subscriber
        $hlr->getOriginalCountryName();   // Getting the original name of the subscriber's country
        $hlr->getOriginalCountryCode();   // Getting the original code of the subscriber's country
        $hlr->getOriginalNetworkName();   // Getting the original name of the subscriber's operator
        $hlr->getOriginalNetworkPrefix(); // Getting the original prefix of the subscriber's operator
        $hlr->getPortedCountryName();     // Getting name of country if subscriber's phone number is ported
        $hlr->getPortedCountryPrefix();   // Getting prefix of country if subscriber's phone number is ported
        $hlr->getPortedNetworkName();     // Getting name of operator if subscriber's phone number is ported
        $hlr->getPortedNetworkPrefix();   // Getting prefix of operator if subscriber's phone number is ported
        $hlr->getRoamingCountryName();    // Getting name of country if the subscriber is in roaming
        $hlr->getRoamingCountryPrefix();  // Getting prefix of country if the subscriber is in roaming
        $hlr->getRoamingNetworkName();    // Getting name of operator if the subscriber is in roaming
        $hlr->getRoamingNetworkPrefix();  // Getting prefix of operator if the subscriber is in roaming
        $hlr->getStatus();                // Getting status of subscriber
        $hlr->getPricePerMessage();       // Getting price for message
        $hlr->isInRoaming();              // Determining if the subscriber is in roaming
        $hlr->isPorted();                 // Identification of ported number
        $hlr->getRequestId();             // Getting request ID
        $hlr->getRequestTime();           // Getting time of request
    }
```

To get information regarding which mobile network a certain phone number belongs to, use the function `getNetworkByPhone($phone)`, where `$phone` is a phone number.
```php
$network = $client->getNetworkByPhone($phone);

$network->getTitle(); // Getting operator of subscriber
```

Please bear in mind that this method has less accuracy than HLR requests as it uses our internal database to check which mobile operator a phone numbers belongs to.

To get a list of incoming messages please use the function `getIncomingMessages($date)`, where `$date` stands for a particular day in YYYY-mm-dd format.
```php
$result = $client->getIncomingMessages($date);

foreach($result as $one){
    $one->getMessageId();  // Getting message ID
    $one->getOriginator(); // Getting sender name of the incoming message
    $one->getPrefix();     // Getting prefix of the incoming message
    $one->getReceivedAt(); // Getting date of the incoming message
    $one->getText();       // Getting text of the incoming message
}
```

Exapmles:
---------
* Send sms, balance, delivery [src/examples/send.php](src/examples/send.php)
* Phone bases [src/examples/base.php](src/examples/base.php)
* Phone bases items [src/examples/baseItems.php](src/examples/baseItems.php)
* Senders [src/examples/senders.php](src/examples/senders.php)
* Incoming messages [src/examples/incoming.php](src/examples/incoming.php)
* Get network by phone [src/examples/network.php](src/examples/network.php)
* Hlr requests and statistics [src/examples/hlr.php](src/examples/hlr.php)
* Statistics usage [src/examples/statistics.php](src/examples/statistics.php)
* Manage blocked phones [src/examples/stopList.php](src/examples/stopList.php)
* Manage templates [src/examples/template.php](src/examples/template.php)