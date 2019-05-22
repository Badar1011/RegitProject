<?php

namespace App\Http\Controllers;



use GuzzleHttp\Client;


class NasaController extends Controller
{


    public function default()
    {
        return view('welcome',[
            'assets' => ''
        ]);
    }

    public function display()
    {
       $attributes = request()->validate([
           'search' => ['required','min:3'],
           'checkbox' => ['required']
       ]);
       $query = $attributes['search'];
       $mediaType = implode(",",$attributes['checkbox']);

       $client = new Client([
           'base_uri' => 'https://images-api.nasa.gov',
           'headers' => [
               'Content-Type' => 'application/json'
           ]
       ]);
       $response = $client->get("/search?q=$query&media_type=$mediaType");

       $assets = json_decode($response->getBody()->getContents())->collection->items;


       return view('welcome',[
           'assets' => $assets,
       ]);
    }

    public function show($id)
    {
        $client = new Client([
            'base_uri' => 'https://images-api.nasa.gov',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
        $response = $client->get("/search?nasa_id=$id");
        $asset = json_decode($response->getBody()->getContents())->collection->items;

        // second client used to get the json data from the url i.e. audio or images
        $client2 = new Client();
        $res = $client2->get($asset[0]->href);
        $media = json_decode($res->getBody()->getContents());
        // assuming it is an image unless changed by the for loop which checks whether its a sound file
        $mediaURL = $media[2];
        foreach ($media as $key=>$value)
        {
            $ext = pathinfo($value, PATHINFO_EXTENSION);
            if (strcmp($ext,"mp3") == 0)
            {
                $mediaURL = $media[$key];
                break;
            }
        }
        return view('asset', [
            'asset' => $asset,
            'media' => $mediaURL,
        ]);
    }
}
