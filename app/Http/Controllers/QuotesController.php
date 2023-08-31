<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Favourite;
use UserHelper;

class QuotesController extends Controller
{
    public function showQuotes(Request $request){
    	$password = $request->password;
    	if($password == 'dummy'){
    		$quotes = $this->getQuotes(5);
    		return view('quotes')->with(['listQuotes' => $quotes]);
    	}
    	else{
    		return Redirect::to('/');
    	}
    }

    public function getQuotes($number){
    	$returnArr = [];
    	for ($i=0; $i < $number; $i++) { 
    		$response = Http::get('https://api.kanye.rest');
        	$jsonResponse = $response->json();	
        	array_push($returnArr, $jsonResponse['quote']);
    	}
        return $returnArr;
    }

    public function saveFavouriteQuotes(Request $request)
    {
    	$favouriteModel = New Favourite();
    	$favouriteQuote = $request->markedFavourite;
    	$favouriteModel->quote = $favouriteQuote;
    	$favouriteModel->save();
    	return Redirect::to('showFavourite');
    }

    public function showFavourite(){
    	$favouriteQuotes = $this->getFavourite();
    	return view('favourite')->with(['listQuotes' => $favouriteQuotes]);
    }

    public function getFavourite(){
    	$favouriteModel = New Favourite();
    	$favouriteQuotes = $favouriteModel->get();
    	return $favouriteQuotes;	
    }

    public function deleteFavourite(Request $request){
    	$id = $request->id;
    	Favourite::where('id',$id)->delete();
    	return Redirect::to('showFavourite');
    }
}
