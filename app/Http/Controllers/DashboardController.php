<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Book;
use App\Model\Author;
use App\Model\Review;
use App\Jobs\SendEmail;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Book::with('Category','Author')->latest()->paginate(10); 
        return view('homepage',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $validated = $request->validate([
            'review' => 'required',
            'rating'    => 'required',
        ]);
        
        $id = decrypt($request->id);
        $book = Book::with('Category','Author','Review')->where('id',$id)->first(); 
        $reviewCheck = Review::where('user_id',\Auth::id())->where('book_id',$id)->with('User','Book')->first();
        if($reviewCheck){
         return back()->with("failed", "You already added review!");
        }

        Review::create([    
            'review'     => $request->review,
            'rating'     => $request->rating,
            'book_id'   => $id,
            'user_id'   => \Auth::id(),
        ]);

        SendEmail::dispatch($book,$request->review,$request->rating,\Auth::user());        
        return back()->with("success", "Review Added Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $book = Book::with('Category','Author','Review')->where('id',$id)->first(); 
        return view('book-listings',['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    public function authorBook(Request $request,$id)
    {
        $id = decrypt($id);
        $data = Author::where('id',$id)->with('Book')->first(); 
        return view('author-book',['data' => $data]);
    }

    public function categoryBook(Request $request,$id)
    {
        $id = decrypt($id);
        $data = Book::where('category_id',$id)->with('Category','Author')->get(); 
        return view('category-book',['data' => $data]);
    }
}
