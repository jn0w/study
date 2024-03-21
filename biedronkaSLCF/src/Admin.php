<?php

require_once 'User.php';

class Admin extends User {


    public function __construct($id, $firstname, $lastname, $email, $password, $address, $contact_number) {
        //admin role set for all admin instances
        parent::__construct($id, $firstname, $lastname, $email, $password, 'admin', $address, $contact_number);
    }


}
