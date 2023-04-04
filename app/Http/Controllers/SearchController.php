<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = DB::table('users')
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('role', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return view('search.userRole', compact('users', 'searchTerm'));
    }
}
