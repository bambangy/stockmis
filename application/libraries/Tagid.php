<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagid {
    public function NewId($length = 10)
    {
        // Limit maximum to 10
        if($length > 10){
            $length = 10;
        }else if($length == 0){
            $length = 10;
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length - 2; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return '#'.$randomString;
    }
}