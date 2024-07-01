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


    public function showAll(Request $request)
    {
        try {
            // Verifica se il parametro 'categories' è presente nella query string
            if ($request->has('categories')) {
                $category = $request->query('categories');

                // Chiamata API per ottenere i prodotti di una categoria specifica
                $productResponse = Http::get('https://fakestoreapi.com/products/category/' . $category);
                $data = $productResponse->json();

                $categories = []; // Se necessario, puoi recuperare anche le categorie qui

                return view('products', compact('data', 'categories'));
            } else {
                // Nessun parametro 'categories' nella query string, mostra tutti i prodotti

                // Chiamata API per ottenere tutti i prodotti
                $productResponse = Http::get('https://fakestoreapi.com/products');
                $data = $productResponse->json();

                // Chiamata API per ottenere tutte le categorie
                $categoryResponse = Http::get('https://fakestoreapi.com/products/categories');
                $categories = $categoryResponse->json();

                return view('products', compact('data', 'categories'));
            }
        } catch (\Exception $e) {
            // Se si verifica un errore, gestisci l'eccezione
            $errorMessage = 'Si è verificato un errore durante il recupero dei dati.';


            // Passa un messaggio di errore alla vista
            return view('products', compact('errorMessage'));
        }
    }








    public function showOne($id)
    {
        // Esegui la richiesta API per ottenere il prodotto specifico
        $productResponse = Http::get('https://fakestoreapi.com/products/'.$id);

        // Verifica se la risposta è stata ricevuta correttamente
        if ($productResponse->successful()) {
            $products = $productResponse->json();

            // Restituisci la vista con i dati del prodotto
            return view('product-single', compact('products'));
        } else {
            // Gestisci il caso in cui la richiesta fallisca
            return abort(404, 'Product not found');
        }
    }

}
