<?php
namespace App\Helpers; // Your helpers namespace 
use Auth;
use Illuminate\Support\Facades\Session;
class Helper
{
    public static function checkValidUser()
    {
        if(Session::has('validUser'))
        {
            return true;
        }
        else{
            return false;
        }
    }
    
}