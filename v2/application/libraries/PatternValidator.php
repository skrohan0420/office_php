<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatternValidator {

    public function isValidDomainPattern($input){
        return preg_match(pattern_email, $input); 
   }
}