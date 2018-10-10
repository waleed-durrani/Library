<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware(['auth' , 'clearance'])->except('index' , 'show');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderby('id')->paginate(9);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'category'=>'required|max:100|unique:categories',
            ]);

            //$categoryName = $request['category'];

        $category = Category::create($request->only('category'));

    //Display a successful message upon save
        return redirect()->route('categories.index')
            ->with('flash_message', 'Category,
             '. $category->category.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //select * from categories where id = $id;
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,['category' => 'required|max:100|unique:categories',]);
        $category = Category::findorFail($id);
        $category->category = $request['category'];
        $category->save();

        return redirect()->route('categories.index')
            ->with('flash_message', 'Category,
             '. $category->category.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findorFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Category successfully deleted');
    }
}
