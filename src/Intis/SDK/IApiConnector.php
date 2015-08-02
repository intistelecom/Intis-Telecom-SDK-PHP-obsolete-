<?php
namespace Intis\SDK;

interface IApiConnector {
    /**
     * Getting data from API.
     *
     * @param $link - URL by API method
     */
    function getContentFromApi($link);

    /**
     * Getting timestamp from API.
     *
     * @param $link - URL by API method
     */
    function getTimestampFromApi($link);
}