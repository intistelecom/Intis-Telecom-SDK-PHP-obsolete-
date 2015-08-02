<?php
namespace Intis\SDK;

class HttpApiConnector implements IApiConnector
{
    /**
     * Getting data from API.
     *
     * @param string $link API address
     * @return bool|mixed|string
     */
    public function getContentFromApi($link){
        $result = file_get_contents($link);
        if ($result === false)
            return false;
        $result = json_decode($result);
        if (!$result)
            return false;

        return $result;
    }

    /**
     * Getting timestamp from API.
     *
     * @param string $link API address
     * @return bool|mixed|string
     */
    public function getTimestampFromApi($link){
        return file_get_contents($link);
    }
}