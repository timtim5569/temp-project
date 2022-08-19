<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index() {
        $label = [];
        $price = [];
        $tags = Tag::get();
        foreach($tags as $tag){
            array_push($label, $tag->name);
            array_push($price, $tag->posts->count());
        }
        return view('chart',['labels'=> $label , 'prices' => $price ]);
    }
}
