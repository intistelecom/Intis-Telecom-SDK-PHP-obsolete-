<?php
namespace Intis\SDK\Entity;

/**
 * Class HLRResponse
 *
 * Class for getting HLR request
 *
 * @package Intis\SDK\Entity
 */
class HLRResponse {

    /**
     * @var integer ID of number
     */
    private $id;
    /**
     * @var integer Recipient
     */
    private $destination;
    /**
     * @var string Status of subscriber
     */
    private $status;
    /**
     * @var string IMSI of subscriber
     */
    private $IMSI;
    /**
     * @var string MCC of subscriber
     */
    private $MCC;
    /**
     * @var string MNC of subscriber
     */
    private $MNC;

    /**
     * @var string The original name of the subscriber's country
     */
    private $originalCountryName;
    /**
     * @var string The original code of the subscriber's country
     */
    private $originalCountryCode;
    /**
     * @var string The original name of the subscriber's operator
     */
    private $originalNetworkName;
    /**
     * @var string The original prefix of the subscriber's operator
     */
    private $originalNetworkPrefix;

    /**
     * @var string Name of country in the subscriber's roaming
     */
    private $roamingCountryName;
    /**
     * @var string Prefix of country in the subscriber's roaming
     */
    private $roamingCountryPrefix;
    /**
     * @var string Operator in the subscriber's roaming
     */
    private $roamingNetworkName;
    /**
     * @var string Prefix of operator in the subscriber's roaming
     */
    private $roamingNetworkPrefix;

    /**
     * @var string Name of country if the phone number of the subscriber is ported
     */
    private $portedCountryName;
    /**
     * @var string Prefix of country if the phone number of the subscriber is ported
     */
    private $portedCountryPrefix;
    /**
     * @var string  Name of operator if the phone number of the subscriber is ported
     */
    private $portedNetworkName;
    /**
     * @var string Prefix of operator if the phone number of the subscriber is ported
     */
    private $portedNetworkPrefix;

    /**
     * @var float Price for message
     */
    private $pricePerMessage;
    /**
     * @var integer Key that is responsible for identification of a ported number
     */
    private $ported;
    /**
     * @var integer Key that is responsible for identification a subscriber in roaming
     */
    private $inRoaming;

    public function __construct($obj) {
        if(isset($obj->id))
            $this->id = $obj->id;
        if(isset($obj->destination))
            $this->destination = $obj->destination;
        $this->status = $obj->stat;
        $this->IMSI = $obj->IMSI;
        $this->MCC = substr($obj->mccmnc, 0, 3);
        $this->MNC = substr($obj->mccmnc, 3);
        
        $this->originalCountryName = $obj->ocn;
        $this->originalCountryCode = $obj->ocp;
        $this->originalNetworkName = $obj->orn;
        $this->originalNetworkPrefix = $obj->onp;
        
        $this->roamingCountryName = $obj->rcn;
        $this->roamingCountryPrefix = $obj->rcp;
        $this->roamingNetworkName = $obj->ron;
        $this->roamingNetworkPrefix = $obj->rnp;
        
        $this->portedCountryName = $obj->pcn;
        $this->portedCountryPrefix = $obj->pcp;
        $this->portedNetworkName = $obj->pon;
        $this->portedNetworkPrefix = $obj->pnp;
        
        $this->pricePerMessage = $obj->ppm;
        $this->ported = $obj->is_ported;
        if(isset($obj->is_roaming))
            $this->inRoaming = $obj->is_roaming;
    }

    /**
     * Getting ID
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Getting status of subscriber
     *
     * @return integer
     */
    public function getStatus() {
        return HLRResponseState::parse($this->status);
    }

    /**
     * Getting recipient
     *
     * @return string
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * Getting IMSI
     *
     * @return string
     */
    public function getIMSI() {
        return $this->IMSI;
    }

    /**
     * Getting MCC of subscriber
     *
     * @return string
     */
    public function getMCC() {
        return $this->MCC;
    }

    /**
     * Getting MNC of subscriber
     *
     * @return string
     */
    public function getMNC() {
        return $this->MNC;
    }

    /**
     * Getting the original name of the subscriber's country
     *
     * @return string
     */
    public function getOriginalCountryName() {
        return $this->originalCountryName;
    }

    /**
     * Getting the original code of the subscriber's country
     *
     * @return string
     */
    public function getOriginalCountryCode() {
        return $this->originalCountryCode;
    }

    /**
     * Getting the original name of the subscriber's operator
     *
     * @return string
     */
    public function getOriginalNetworkName() {
        return $this->originalNetworkName;
    }

    /**
     * Getting the original prefix of the subscriber's operator
     *
     * @return string
     */
    public function getOriginalNetworkPrefix() {
        return $this->originalNetworkPrefix;
    }

    /**
     * Getting name of country if the subscriber is in roaming
     *
     * @return string
     */
    public function getRoamingCountryName() {
        return $this->roamingCountryName;
    }

    /**
     * Getting prefix of country if the subscriber is in roaming
     *
     * @return string
     */
    public function getRoamingCountryPrefix() {
        return $this->roamingCountryPrefix;
    }

    /**
     * Getting name of operator if the subscriber is in roaming
     *
     * @return string
     */
    public function getRoamingNetworkName() {
        return $this->roamingNetworkName;
    }

    /**
     * Getting prefix of operator if the subscriber is in roaming
     *
     * @return string
     */
    public function getRoamingNetworkPrefix() {
        return $this->roamingNetworkPrefix;
    }

    /**
     * Getting name of country if subscriber's phone number is ported
     *
     * @return string
     */
    public function getPortedCountryName() {
        return $this->portedCountryName;
    }

    /**
     * Getting prefix of country if subscriber's phone number is ported
     *
     * @return string
     */
    public function getPortedCountryPrefix() {
        return $this->portedCountryPrefix;
    }

    /**
     * Getting name of operator if subscriber's phone number is ported
     *
     * @return string
     */
    public function getPortedNetworkName() {
        return $this->portedNetworkName;
    }

    /**
     * Getting prefix of operator if subscriber's phone number is ported
     *
     * @return string
     */
    public function getPortedNetworkPrefix() {
        return $this->portedNetworkPrefix;
    }

    /**
     * Getting price for message
     *
     * @return float
     */
    public function getPricePerMessage() {
        return $this->pricePerMessage;
    }

    /**
     * Identification of ported number
     *
     * @return boolean
     */
    public function isPorted() {
        if($this->ported == 'true')
            return true;
        return false;
    }

    /**
     * Determining if the subscriber is in roaming
     *
     * @return boolean
     */
    public function isInRoaming() {
        if($this->inRoaming == 'true')
            return true;
        return false;
    }
}
