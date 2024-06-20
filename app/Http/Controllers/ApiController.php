<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function index()
    {
       try{
        //Fetch the products from the API
          $productResponse = Http::get('https://fakestoreapi.com/products?limit=6');
          $data= $productResponse->json();

          //Fetch the categories from API
          $categoryResponse = Http::get('https://fakestoreapi.com/products/categories');
          $categories= $categoryResponse->json();


          return view('welcome', compact(['data', 'categories']));

       }catch(\Exception $e){

            $e = $e->getMessage();

          return view('welcome', compact('e'));
       }


    }

    public function showAll()
    {
        try{
        $productResponse = Http::get('https://fakestoreapi.com/products');
        $data= $productResponse->json();

        $categoryResponse = Http::get('https://fakestoreapi.com/products/categories');
        $categories= $categoryResponse->json();
        return view('products', compact('data', 'categories'));

        }catch(\Exception $e){
            $e = $e->getMessage();

            return view('products', compact('e'));
        }
    }


}
