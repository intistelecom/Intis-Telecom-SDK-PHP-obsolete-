Intis-Telecom-SDK-PHP
=====================

Installation using Composer
---------------------------

$ composer require intis/sdk

Usage
---------------------------

class IntisClient - The main class for SMS sending and getting API information

ƒл€ инициализации необходимо передать в конструктор три об€зательных параметра
$login - user login
$apiKey - user API key
$apiHost - API address

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Intis\SDK\IntisClient;

$client = new IntisClient($login, $apiKey, $apiHost);
```

 ласс содержит следующие методы:
--------------------------------

Getting user balance `$client->getBalance()`
```php
$balance = $client->getBalance();

$amount = $balance->getAmount(); // Getting amount of money
$currency = $balance->getCurrency(); // Getting name of currency
```

Getting all user lists `getPhoneBases()`
```php
$phoneBases = $client->getPhoneBases();

foreach($phoneBases as $oneBase){
    $oneBase->getBaseId(); // Getting list ID
    $oneBase->getTitle(); // Getting list name
    $oneBase->getCount(); // Getting number of contacts in list
    $oneBase->getPages(); // Getting number of pages in list

    $birthday = $oneBase->getBirthdayGreetingSettings(); // Getting settings of birthday greetings
    $birthday->getEnabled(); // Getting key that is responsible for sending greetings, 0 - do not send, 1 - send
    $birthday->getDaysBefore(); // Getting the number of days to send greetings before
    $birthday->getOriginator(); // Getting name of sender for greeting SMS
    $birthday->getTimeToSend(); // Getting time for sending greetings. All SMS will be sent at this time.
    $birthday->getUseLocalTime(); // Getting variable that indicates using of local time while SMS sending.
    $birthday->getTemplate(); // Getting text template that will be used in the messages.
}
```

Getting all user sender names `$client->getOriginators()`
```php
$originators = $client->getOriginators();

foreach($originators as $originator){
    $originator->getOriginator(); // Getting sender name
    $originator->getState(); // Getting sender status
}
```

Getting subscribers of list `$client->getPhoneBaseItems($baseId, $page)` $baseId - List ID (об€зательный параметр), $page - Page of list (необ€зательный параметр)
```php
$items = $client->getPhoneBaseItems($baseId, $page);

foreach($items as $item){
    $item->getPhone(); // Getting subscriber number
    $item->getFirstName(); // Getting subscriber first name
    $item->getMiddleName(); // Getting subscriber middle name
    $item->getLastName(); // Getting subscriber last name
    $item->getBirthDay(); // Getting subscriber birthday
    $item->getGender(); // Getting gender of subscriber
    $item->getNetwork(); // Getting operator of subscriber
    $item->getArea(); // Getting region of subscriber
    $item->getNote1(); // Getting subscriber note 1
    $item->getNote2(); // Getting subscriber note 2
}
```

Getting message status `$client->getDeliveryStatus($messageId)` $messageId - Message ID
```php
$deliveryStatus = $client->getDeliveryStatus($messageId);

foreach($deliveryStatus as $message){
    $message->getMessageId(); // Getting message ID
    $message->getMessageStatus(); // Getting a message status
    $message->getCreatedAt(); // Getting a time of message
}
```

SMS sending `$client->sendMessage($phone, $originator, $text)`  $phone - phone number(s) (array|string), $originator - sender name, $text sms text.
ћассив содержит `MessageSendingSuccess` если сообщение успешно отправлено или `MessageSendingError` если возникла ошибка
```php
$messages = $client->sendMessage($phone, $originator, $text);

foreach($messages as $one){
    if($one->isOk()) { // флаг успешной отправки сообщени€
        $one->getPhone(); // Getting phone number
        $one->getMessageId(); // Getting message ID
        $one->getCost(); // Getting price for message
        $one->getCurrency(); // Getting name of currency
        $one->getMessagesCount(); // Getting number of message parts
    }
    else{
        $one->getPhone(); // Getting phone number
        $one->getMessage(); // Getting error message
        $one->getCode(); // Getting code error in SMS sending
    }

}
```

Testing phone number for stop list `$client->checkStopList($phone)` $phone - phone number
```php
$stopList = $client->checkStopList($phone);

$stopList->getId(); // Getting ID in stop list
$stopList->getDescription(); // Getting reason of adding to stop list
$stopList->getTimeAddedAt(); // Getting time of adding to stop list
```

Adding number to stop list `$client->addToStopList($phone)` $phone - phone number
```php
$id = $client->addToStopList($phone); // return ID in stop list
```

Getting user templates `$client->getTemplates()`
```php
$templates = $client->getTemplates();

foreach ($templates as $template) {
    $template->getId(); // Getting template ID
    $template->getTitle(); // Getting template name
    $template->getTemplate(); // Getting text of template
    $template->getCreatedAt(); // ѕолучение времени создани€ шаблона
}
```

Adding user template `$client->addTemplate($title, $template)` $title - template name, $template - text of template
```php
$templteId = $client->addTemplate($title, $text); // return ID user template
```

Getting statistics for the certain month `$client->getDailyStatsByMonth($year, $month)` $year - year, $month - month (format date YYYY-mm-dd)
```php
$result = $client->getDailyStatsByMonth($year, $month);

foreach($result as $one){
    $one->getDay(); // Getting day of month

    $stats = $one->getStats(); // Getting daily statistics
    foreach($stats as $i){
        $i->getState(); // Getting status of message
        $i->getCost(); // Getting prices of message
        $i->getCurrency(); // Getting name of currency
        $i->getCount(); // Getting number of message parts
    }
}
```

Sending HLR request for number `$client->makeHLRRequest($phone)` $phone - phone number
```php
$result = $client->makeHLRRequest($phone);

foreach ($result as $hlr) {
    $hlr->getId(); // Getting ID
    $hlr->getDestination(); // Getting recipient
    $hlr->getIMSI(); // Getting IMSI
    $hlr->getMCC(); // Getting MCC of subscriber
    $hlr->getMNC(); // Getting MNC of subscriber
    $hlr->getOriginalCountryName(); // Getting the original name of the subscriber's country
    $hlr->getOriginalCountryCode(); // Getting the original code of the subscriber's country
    $hlr->getOriginalNetworkName(); // Getting the original name of the subscriber's operator
    $hlr->getOriginalNetworkPrefix(); // Getting the original prefix of the subscriber's operator
    $hlr->getPortedCountryName(); // Getting name of country if subscriber's phone number is ported
    $hlr->getPortedCountryPrefix(); // Getting prefix of country if subscriber's phone number is ported
    $hlr->getPortedNetworkName(); // Getting name of operator if subscriber's phone number is ported
    $hlr->getPortedNetworkPrefix(); // Getting prefix of operator if subscriber's phone number is ported
    $hlr->getRoamingCountryName(); // Getting name of country if the subscriber is in roaming
    $hlr->getRoamingCountryPrefix(); // Getting prefix of country if the subscriber is in roaming
    $hlr->getRoamingNetworkName(); // Getting name of operator if the subscriber is in roaming
    $hlr->getRoamingNetworkPrefix(); // Getting prefix of operator if the subscriber is in roaming
    $hlr->getStatus(); // Getting status of subscriber
    $hlr->getPricePerMessage(); // Getting price for message
    $hlr->isInRoaming(); // Determining if the subscriber is in roaming
    $hlr->isPorted(); // Identification of ported number
}
```

Getting statuses of HLR request `$client->getHlrStats($from, $to)` $from - дата начала периода, $to - дата конца периода
```php
$result = $client->getHlrStats($from, $to);

foreach($result as $hlr){
        $hlr->getId(); // Getting ID
        $hlr->getPhone(); // Getting phone number
        $hlr->getMessageId(); // Getting message ID
        $hlr->getTotalPrice(); // Getting final price of request
        $hlr->getDestination(); // Getting recipient
        $hlr->getIMSI(); // Getting IMSI
        $hlr->getMCC(); // Getting MCC of subscriber
        $hlr->getMNC(); // Getting MNC of subscriber
        $hlr->getOriginalCountryName(); // Getting the original name of the subscriber's country
        $hlr->getOriginalCountryCode(); // Getting the original code of the subscriber's country
        $hlr->getOriginalNetworkName(); // Getting the original name of the subscriber's operator
        $hlr->getOriginalNetworkPrefix(); // Getting the original prefix of the subscriber's operator
        $hlr->getPortedCountryName(); // Getting name of country if subscriber's phone number is ported
        $hlr->getPortedCountryPrefix(); // Getting prefix of country if subscriber's phone number is ported
        $hlr->getPortedNetworkName(); // Getting name of operator if subscriber's phone number is ported
        $hlr->getPortedNetworkPrefix(); // Getting prefix of operator if subscriber's phone number is ported
        $hlr->getRoamingCountryName(); // Getting name of country if the subscriber is in roaming
        $hlr->getRoamingCountryPrefix(); // Getting prefix of country if the subscriber is in roaming
        $hlr->getRoamingNetworkName(); // Getting name of operator if the subscriber is in roaming
        $hlr->getRoamingNetworkPrefix(); // Getting prefix of operator if the subscriber is in roaming
        $hlr->getStatus(); // Getting status of subscriber
        $hlr->getPricePerMessage(); // Getting price for message
        $hlr->isInRoaming(); // Determining if the subscriber is in roaming
        $hlr->isPorted(); // Identification of ported number
        $hlr->getRequestId(); // Getting request ID
        $hlr->getRequestTime(); // Getting time of request
    }
```

Getting the operator of subscriber phone number `$client->getNetworkByPhone($phone)` $phone - phone number
```php
$network = $client->getNetworkByPhone($phone);

$network->getTitle(); // Getting operator of subscriber
```

Getting incoming messages of certain date `$client->getIncomingMessages($date)` $date - date (format date YYYY-mm-dd)
```php
$result = $client->getIncomingMessages($date);

foreach($result as $one){
    $one->getMessageId(); // Getting message ID
    $one->getOriginator(); // Getting sender name of the incoming message
    $one->getPrefix(); // Getting prefix of the incoming message
    $one->getReceivedAt(); // Getting date of the incoming message
    $one->getText(); // Getting text of the incoming message
}
```