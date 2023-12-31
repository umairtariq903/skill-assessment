<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Favourite;
use App\Models\Quote;
use Helper;

class QuotesController extends Controller
{
    /**
     * Show 5 Quotes if user enter valid password or user already logged in
     */
    public function showQuotes(Request $request){
    	Session::put('validUser', true);
        $quotes = $this->getQuotes(5);
        return view('quotes')->with(['listQuotes' => $quotes]);
    }

    /**
     * call the given Api for the number of times asked by user through api or web, it is a common function
     */
    public function getQuotes($number){
    	$returnArr = [];
        // Fetch new from Api
    	for ($i=0; $i < $number; $i++) { 
    		$response = Http::get('https://api.kanye.rest');
        	$jsonResponse = $response->json();	
        	array_push($returnArr, $jsonResponse['quote']);
    	}
        $this->refreshQuotes($returnArr);
        return $returnArr;
    }

    /**
     * save quotes in database
     */
    public function refreshQuotes($quotes){
        //clear already saved quotes as we are refreshing
        foreach ($quotes as $quote) {
            $quoteModel = New Quote();
            $quoteModel->quote = $quote;
            $quoteModel->save();
        }
    }

    /**
     * save favourite quotes in database
     */
    public function saveFavouriteQuotes(Request $request,$markedFavourite=null)
    {
    	$favouriteModel = New Favourite();
    	$favouriteQuote = $request->markedFavourite;
    	$favouriteModel->quote = $favouriteQuote;
    	$favouriteModel->save();
    	return Redirect::to('showFavourite');
    }

    /**
     * save favourite quotes APi in database
     */
    public function saveFavouriteQuotesApi($markedFavourite)
    {
        $favouriteModel = New Favourite();
        $favouriteQuote = $markedFavourite;
        $favouriteModel->quote = $favouriteQuote;
        $favouriteModel->save();
        return [
            "status" => 1,
            "msg" => "Quote saved as favourite successfully"
        ];
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
    public function listSpecificQuotes(Request $request, $number, $refresh = null){
        if($refresh){
            //clear already saved quotes as we are refreshing
            $quoteModel = New Quote();
            $quoteModel::truncate();
            $Quotes = $this->getQuotes($number);    
        }
        else{
            $Quotes = $this->getSavedQuotes($number);   
        }
    	
    	return [
            "status" => 1,
            "data" => $Quotes,
            "msg" => "Quotes listed successfully"
        ];
    }

    /**
     * get Saved quotes from db
     */
    public function getSavedQuotes($number){
        $quoteModel = New Quote();
        $quotes = $quoteModel->all();
        $returnArr = [];
        foreach ($quotes as $quote) {
            array_push($returnArr, $quote->quote);
        }
        return $returnArr;
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

    /**
     * get user api
     */
    public function getUser($password){
        $user = User::where('password',$password)->first();
        if ($user) {
            return [
                "status" => 1,
                "msg" => "User logged In",
                "data" => $user
            ];
        }
        else{
            return [
                "status" => 0,
                "msg" => "Unauthorized"
            ];
        }
        
    }
}
