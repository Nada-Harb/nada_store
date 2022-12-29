<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriescontroller extends Controller
{
    public function index()
    {
        // SQL: 
        // SELECT * FROM categories WHERE parent_id  = 1 ORDER BY name
        // Return collection object (array)
        
        $categories = Category::orderBy('parent_id')
            ->orderBy('parent_id')
            ->orderBy('name', 'ASC')
            ->get();

        return view('dashboard.categories.index', [
            'categories' => $categories,
            'status'  => session('status'),
        ]);
    
    }
    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
       Category::create([
            'name' => $request->post('name'),
            'slug' => $request->post('slug'),
            'parent_id' => $request->post('parent_id'),
            'created_at' => now(),

        ]);

        //PRG - Post Redirect Get + Flash Massage
        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category Created');

    }
}


