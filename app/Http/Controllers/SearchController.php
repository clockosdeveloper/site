<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;

class SearchController extends Controller
{
    public function quest()
    {
        $term = \Input::get('q');
        $incomplete_results = true;
        $items = Quest::where('fullname', 'LIKE', "%$term%")->get()->take(30);
        return response()->json(['items' => $items, 'incomplete_results' => $incomplete_results]);
    }
}
