<?php
namespace Intis\SDK\Entity;

/**
 * Class Template
 *
 * Class for getting user templates
 *
 * @package Intis\SDK\Entity
 */
class Template{
    /**
     * @var integer Template ID
     */
    private $id;
    /**
     * @var string Template name
     */
    private $title;
    /**
     * @var string Text of template
     */
    private $template;
    /**
     * @var string Time of adding template
     */
    private $createdAt;
    
    public function __construct($id, $obj) {
        $this->id = $id;
        $this->title = $obj->name;
        $this->template = $obj->template;
        $this->createdAt = $obj->up_time;
    }

    /**
     * Getting template ID
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Getting template name
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Getting text of template
     *
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Getting time of template
     *
     * @return string
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
}

