<?php
namespace Intis\SDK\Entity;

/**
 * Class DailyStats
 *
 * Class for getting daily statistics
 *
 * @package Intis\SDK\Entity
 */
class DailyStats{
    /**
     * @var string day for statistics output
     */
    private $day;
    /**
     * @var object variable for storing statistics
     */
    private $stats;
    
    public function __construct($day, $stats) {
        $this->day = $day;
        $this->stats = $stats;
    }

    /**
     * Getting day of month
     *
     * @return string
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * Getting daily statistics
     *
     * @return object
     */
    public function getStats() {
        return $this->stats;
    }
}

