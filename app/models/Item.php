<?php


class Item  {

	// Properties
    private $name;
    public $email;
    public $logged_in = false;

function __construct() {
       // echo 'You just created a new user!';
    }

    public function __toString()
    {
        return $this->name;
    }
    

	//Methods
	public function getName() {
        return $this->name;
    }   
    public function setName($new_name) {
        $this->name = $new_name;
    }

}
