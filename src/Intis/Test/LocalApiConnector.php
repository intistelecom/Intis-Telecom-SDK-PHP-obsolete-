<?php
namespace Intis\Test;

use Intis\SDK\IApiConnector;

class LocalApiConnector implements IApiConnector{

    private $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function getContentFromApi($link){
        return $this->data;
    }

    public function getTimestampFromApi($link){
        return null;
    }
}