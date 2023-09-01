<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Favourite;
use Helper;

class QuotesController extends Controller
{
    /**
     * Show 5 Quotes if user enter valid password or user already logged in
     */
    public function showQuotes(Request $request){
    	if (isset($request->password)) {
    		$user = User::where('password', $request->password)->first();
    		if($user){
    			Session::put('validUser', true);
	    		$quotes = $this->getQuotes(5);
	    		return view('quotes')->with(['listQuotes' => $quotes]);
	    	}
	    	else{
	    		return Redirect::to('/');
	    	}	
    	}
    	elseif (Helper::checkValidUser()) {
    		$quotes = $this->getQuotes(5);
	    	return view('quotes')->with(['listQuotes' => $quotes]);
    	}else{
    		return Redirect::to('/');
    	}
    	
    	
    }

    /**
     * call the given Api for the number of times asked by user through api or web, it is a common function
     */
    public function getQuotes($number){
    	$returnArr = [];
    	for ($i=0; $i < $number; $i++) { 
    		$response = Http::get('https://api.kanye.rest');
        	$jsonResponse = $response->json();	
        	array_push($returnArr, $jsonResponse['quote']);
    	}
        return $returnArr;
    }

    /**
     * save favourite quotes in database
     */
    public function saveFavouriteQuotes(Request $request)
    {
    	$favouriteModel = New Favourite();
    	$favouriteQuote = $request->markedFavourite;
    	$favouriteModel->quote = $favouriteQuote;
    	$favouriteModel->save();
    	return Redirect::to('showFavourite');
    }

    /**
     * display favourite quotes for web
     */
    public function showFavourite(){
    	if (Helper::checkValidUser()) {
    		$favouriteQuotes = $this->getFavourite();
    		return view('favourite')->with(['listQuotes' => $favouriteQuotes]);	
    	}else{
    		return Redirect::to('/');
    	}
    	
    }

    /**
     * get favourite quotes from db . It is common function for web and api
     */
    public function getFavourite(){
    	$favouriteModel = New Favourite();
    	$favouriteQuotes = $favouriteModel->get();
    	return $favouriteQuotes;	
    }

    /**
     * delete favourite quote
     */
    public function deleteFavourite(Request $request){
    	$id = $request->id;	
    	Favourite::where('id',$id)->delete();
    	return Redirect::to('showFavourite');
    }

    /**
     * list favourite quotes from db for api
     */
    public function listAllFavourite(){
    	$favouriteQuotes = $this->getFavourite();
    	return [
            "status" => 1,
            "data" => $favouriteQuotes,
            "msg" => "Favourite listed successfully"
        ];
    }

    /**
     * list  quotes for api
     */
    public function listSpecificQuotes(Request $request, $number){
    	$Quotes = $this->getQuotes($number);
    	return [
            "status" => 1,
            "data" => $Quotes,
            "msg" => "Quotes listed successfully"
        ];
    }

    /**
     * delete quotes api
     */
    public function deleteFavouriteApi($id){
    	Favourite::where('id',$id)->delete();
    	return [
            "status" => 1,
            "msg" => "Quote deleted successfully"
        ];
    }
}
