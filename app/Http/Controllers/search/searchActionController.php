<?php

namespace App\Http\Controllers\search;

use App\Http\Controllers\Controller;
use App\Models\searchHistory;
use Illuminate\Http\Request;
use Modules\Blog\Models\blog;
use Modules\Product\Product\Models\product;

class searchActionController extends Controller
{
    public function searchAction(Request $request)
    {
    $query = $request->input('query');
    if(empty($query)){
        return response()->json(['error'=>'لطفاً عبارت مورد جستجو را وارد کنید']);
    }


    $searchHistory = searchHistory::create([
        'text_search'=>$query,
        'user_id'=> auth()->user()->id ?? null
    ]);


    $products = product::where('title', 'LIKE', "%$query%")
        ->orWhere('id', 'LIKE', "%$query%")
        ->get();

    $articles = blog::where('title', 'LIKE', "%$query%")
        // ->orWhere('body', 'LIKE', "%$query%")
        ->get();

    return response()->json([
        'products' => $products,
        'articles' => $articles,
    ]);


    }
}
