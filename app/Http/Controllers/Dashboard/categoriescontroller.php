<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;

class categoriescontroller extends Controller
{
    public function index()
    {
        // SQL: 
        // SELECT categories.*, parents.name as parent_name FROM categories
        //LEFT JOIN categories as parents ON parents.id = categories.parent_id
        // Return collection object (array)
        
        $categories = Category::query()
            ->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name',
            ])
            ->orderBy('categories.parent_id')
            ->orderBy('categories.name', 'ASC')
            ->get();

        return view('dashboard.categories.index', [
            'categories' => $categories,
            'status'  => session('status'),
        ]);
    
    }
    public function create()
    {
        $parents = Category::orderBy('name')->get();
        return view('dashboard.categories.create', [
            'category' => new Category(),
            'parents' => $parents,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // $category = new Category($request->all());
        // $category->name = $request->name;
        // $category->slug = $request->input('slug');
        // $category->parent_id = $request->post('parent_id');
        // $category->save();

        //Mass Assignment
       
        $category = Category::create($data);




        //PRG - Post Redirect Get + Flash Massage
        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category ({$categoty->name}) Created!');

    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        // SELECT * FORM categories WHERE
        // id <> @id AND (parent_id <> $id OR parent_id IS NULL) 

        $parents = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', '<>', $id);
            })
            ->orderBy('name')
            ->get();
        
        return view('dashboard.categories.edit', [
            'category' => $category,
            'parents' => $parents,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        //$category->name = $request->name;
        //$category->save();

        //$data = $this->validateRequest($request, $id); 

        $category->update( $request->all );

        return redirect()
            ->route('dashboard.categories.index')
            ->with('status', 'Category ({$categoty->name}) Updated!');
    }

    public function destroy($id)
    {
        //Category::where('id', '=', $id)->delete;
        Category::destroy($id); 

        //$category = Category::findOrFail($id);
        //$category->delete();

        return redirect()
            ->back()
            ->with('status', 'Category Deleted!');
    }

    protected function validateRequest(Request $request, $id =0)
    {
        $rules = ['name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug, $id',
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => [
                'nullable',
                'image',
                'max:200',
                Rule::dimensions()->minHeight(300)->maxHeight(1200)->minWidth(300)->maxWidth(1200),
                ]
            ];
            $messages = [
                'required' => ':attribute is required!!',
                'slug.required' => 'You must enter a URL slug',
            ];
            return $request->validate($rules, $messages);
    }
    
}


