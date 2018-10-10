<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Post;
use Auth;
use Session;
use App\Book;
use App\Category;

class BookController extends Controller
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
        //$categories = Book::distinct()->select('category','id')->get();//->paginate(5); //show only 5 items at a time in descending order
        //$categories = Category::all();
        //return view('books.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('category','id')->toArray();
        //$category_id = Category::pluck('id');
        //$categories = Category::orderby('id');
      //  $category_id = Category::all();
        //return view('books.create',compact('categories','category_id'));
        return view('books.create',compact('categories'));
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
        //echo $request['categories'];
        //echo "<br>".$request['available'];
        $this->validate($request,[
            'categories'=>'required',
            'name'=>'required|max:150',
            'edition'=>'max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
            'available'=>'required|max:100',
            ]);

            //$categoryName = $request['category'];

        //$book = Book::create($request->all());
        //New Object of Book Model is being created for inserting into books table
        try { 
        $book= new Book();
        $book->category_id = $request['categories'];
        $book->name = $request['name'];
        $book->edition = $request['edition'];
        $book->author = $request['author'];
        $book->publisher = $request['publisher'];
        $book->available= $request['available'];
        if($request['edition'] == null){
            $book->edition = '1st Edition';
        }
        $book->save();
    } catch(QueryException $ex){ 
        $allowedCodes = array('23000',);           // Integrity constraint violation
        if(in_array($ex->getCode(),$allowedCodes)){

        $this->validate($request,['name'=>'required|max:150|unique:books',]);
        $book->save();
        }
        else{
             dd($ex->getMessage()); 
        }
          }
        //  if($fail == false){
        //     $this->validate($request,['name'=>'required|max:150|unique:books',]);
        //  }
        

            //echo mysqli_error($pass);
        
    //Display a successful message upon save
        return redirect()->route('books.show',$request['categories'])
            ->with('flash_message', 'Book,
             '. $book->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //hasBooks is a function of Model:Category (can be used as an attribute),
    // it returns books related to the specified category, it searches the child 
    //table(books) foreign key colomn for the matching category.
    //we have used primary key of categories table and that primary key is
    // matched to the foreign key of books table
        $books = Category::find($id)->hasBooks;
        return view ('books.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //Using Book id which is being edited, we call upon the property/function ( category() ) of Book.php (Model)
    // which returns the category row from the parent table (categories), we then took the id of that category.
        //$category_id = Book::find($id)->category->id;
    //pluck selects all of rows data of the given columns,toArray is used to convert rows into array
        $categories = Category::pluck('category','id')->toArray();
        $book = Book::findOrFail($id);
        $category_id = $book->category->id;
        return view('books.edit', compact('book','categories','category_id'));
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
        $this->validate($request,[
            'categories'=>'required',
            'name'=>'required|max:150',
            'edition'=>'max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
            'available'=>'required|max:100',
            ]);


            //$categoryName = $request['category'];

        //$book = Book::create($request->all());
        //selecting the specified book using id and then making changes
        try{
        $book= Book::findOrFail($id);
        $book->category_id = $request['categories'];
        $book->name = $request['name'];
        $book->edition = $request['edition'];
        $book->author = $request['author'];
        $book->publisher = $request['publisher'];
        $book->available= $request['available'];
        if($request['edition'] == null){ $book->edition = '1st Edition'; }
        $book->save();

        } catch(QueryException $ex){ 
    
            $allowedCodes = array('23000',);           // Integrity constraint violation
            if(in_array($ex->getCode(),$allowedCodes)){

            $this->validate($request,['name'=>'required|max:150|unique:books',]);
            $book->save();
            }
            else{
                 dd($ex->getMessage()); 
            }
          }
        

    //Display a successful message upon save
        return redirect()->route('books.show',$request['categories'])
            ->with('flash_message', 'Book,
             '. $book->name.' edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //category is a function in Model:Book.php, it returns the category object of the
        //specified Book.
        $category = Book::find($id)->category;
        $book = Book::findOrFail($id);
        $book->delete();
        
        //$category = Book::find($id)->category;
       
        return redirect()->route('books.show',$category->id)
            ->with('flash_message',
             'Book successfully deleted');
    }
}
