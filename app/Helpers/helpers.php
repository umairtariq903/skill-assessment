<?php
namespace App\Helpers; // Your helpers namespace 
use Auth;
class UserHelper
{
    public static function getUser(int $userid): ?object
    {
        return User::find($id);
    }
    public static function getCurrentUser(): ?object
    {
         return Auth::user();
    }
    public static function getUserCompany(): ?object
    {
        $companyId = Auth::user()->comp_id;
        return Company::find($companyId);
    }
}