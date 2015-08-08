Intis-Telecom-SDK-PHP
=====================

Компания Интис Телеком позволяет отправлять СМС по всему миру, используя API. Он основан на отправке HTTP(s) запросов и получения ответной информации в JSON или XML. Основной функционал, поддерживаемый API:

* отправка СМС, в том числе, в назначенное время
* получение отчета о доставке ранее отправленной СМС
* запрос списка разрешенных отправителей
* запрос списка входящих СМС
* запрос баланса
* запрос списка баз
* запрос номеров из базы
* поиск номера в стоп-листе
* добавление номера в стоп-лист
* запрос списка шаблонов
* добавление шаблона
* общая статистика за месяц
* HLR запрос
* статистика HLR запросов
* запрос оператора по номеру телефона

Для начала работы с сервисом, Вам необходимо зарегестрироваться на сайте https://go.intistele.com/external/client/register/. Получить login и API ключ

Installation using Composer
---------------------------

$ composer require intis/sdk

Usage
---------------------------

class IntisClient - The main class for SMS sending and getting API information

Для инициализации необходимо передать в конструктор три обязательных параметра
$login - user login
$apiKey - user API key
$apiHost - API address

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Intis\SDK\IntisClient;

$client = new IntisClient($login, $apiKey, $apiHost);
```

Класс содержит следующие методы:
--------------------------------

Для запроса баланса Вашего лицевого счета в сервисе используется метод `getBalance()`
```php
$balance = $client->getBalance();

$amount = $balance->getAmount(); // Getting amount of money
$currency = $balance->getCurrency(); // Getting name of currency
```

Запросить список всех имеющихся в Вашей системе телефонных баз `getPhoneBases()`
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

В системе предусмотрена возможность создать неограниченное количество имен отправителей СМС.
Для получения списка отправителей используется метод `getOriginators()`
```php
$originators = $client->getOriginators();

foreach($originators as $originator){
    $originator->getOriginator(); // Getting sender name
    $originator->getState(); // Getting sender status
}
```

Для получения списка номеров телефонов из определенной базы абонентов в личном кабинете используется метод `getPhoneBaseItems($baseId, $page)`. Для удобства весь список разбит на страницы.
Параметры: $baseId - ID телефонной базы в системе (обязательный параметр), $page - Номер страницы в базе (необязательный параметр)
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

Для получения информации по статусам отправленных СМС используется функция `getDeliveryStatus($messageId)` $messageId - ID отправленного сообщения.
(Возможна передача в качестве параметра ID одного или нескольких статусов массивом или строкой через запятую).
```php
$deliveryStatus = $client->getDeliveryStatus($messageId);

foreach($deliveryStatus as $message){
    $message->getMessageId(); // Getting message ID
    $message->getMessageStatus(); // Getting a message status
    $message->getCreatedAt(); // Getting a time of message
}
```

Для отправки СМС (в том числе и нескольким абонентам) используется функция `sendMessage($phone, $originator, $text)`
$phone - номер телефона на который необходимо отправить сообщение (Допускается передача в качестве параметра $phone одного или несколько номеров телефонов массивом или строкой через запятую),
$originator - имя отправителя от имени которого идет рассылка, $text - текст смс.
Массив содержит `MessageSendingSuccess` если сообщение успешно отправлено или `MessageSendingError` если возникла ошибка
```php
$messages = $client->sendMessage($phone, $originator, $text);

foreach($messages as $one){
    if($one->isOk()) { // флаг успешной отправки сообщения
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

Добавить номер в СТОП-лист `addToStopList($phone)` $phone - phone number
```php
$id = $client->addToStopList($phone); // return ID in stop list
```

Для проверки наличия телефонного номера в СТОП-листе необходимо воспользоваться функцией `checkStopList($phone)`. Где $phone - phone number
```php
$stopList = $client->checkStopList($phone);

$stopList->getId(); // Getting ID in stop list
$stopList->getDescription(); // Getting reason of adding to stop list
$stopList->getTimeAddedAt(); // Getting time of adding to stop list
```

В системе предусмотрена возможность создания множества шаблонов СМС сообщений. Для получения списка таких шаблонов используется функция `getTemplates()`.
В ответ возвращается список всех имеющихся в данной учетной записи шаблонов.
```php
$templates = $client->getTemplates();

foreach ($templates as $template) {
    $template->getId(); // Getting template ID
    $template->getTitle(); // Getting template name
    $template->getTemplate(); // Getting text of template
    $template->getCreatedAt(); // Получение времени создания шаблона
}
```

Для добавления нового шаблона в систему используется функция `addTemplate($title, $template)`. Где $title - template name, $template - text of template
```php
$templteId = $client->addTemplate($title, $text); // return ID user template
```

Для получения статистики отправки сообщения за определенный месяц используется функция `getDailyStatsByMonth($year, $month)`.
Где $year - год и $month - месяц за который необходимо получить статистику.
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

HLR (Home Location Register) — это централизованная база данных, которая содержит подробную информацию о каждом абоненте мобильных сетей GSM-операторов.
HLR запрос позволяет выполнить проверку телефонных номеров (в том числе и списком), определяя доступность абонентов для дальнейшей очистки базы данных от неактуальных номеров.
Для осуществления HLR запроса в системе предусмотрена функция `makeHLRRequest($phone)`.
(Допускается передавать в качестве параметра $phone один или несколько телефонов массивом или строкой через запятую)
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

Кроме того, возможно получить статистику HLR запросов за определенный период времени `getHlrStats($from, $to)`.
Где $from - дата начала периода, $to - дата конца периода
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

Для получения информации о пренадлежности определенного номера какому-либо оператору используется функция `getNetworkByPhone($phone)`. Где $phone - номер телефона
```php
$network = $client->getNetworkByPhone($phone);

$network->getTitle(); // Getting operator of subscriber
```
Следует отметить, что данный метод является менее точным, чем HLR запрос, т.к. использует внутреннюю базу данных компании Интис Телеком о пренадлежности абонентов определенному оператору.

Для получения списка входящих сообщений необходимо воспользоваться функцией `getIncomingMessages($date)`. Где $date - интересующая Вас дата (format date YYYY-mm-dd)
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