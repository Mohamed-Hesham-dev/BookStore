<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Section;
use App\Book;

class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
    public function store(Request $request)
    {
        //
        DB::transaction(function() use($request){
        $author_id=1;
        $another_author=$request->author;
        $author2=DB::table("authors")
                    ->where("first_name",$another_author)
                    ->select("id")
                    ->first();


        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_description=$request->book_description;;
        $section_id=$request->section_id;
        $ID_Book=DB::table("books")
            ->insertGetId(["book_title"=>$book_title,
                      "book_edition"=>$book_edition,
                      "book_description"=>$book_description,
                       "section_id"=>$section_id]);

        if($author2!=null)
        {
            $author2_id=$author2->id;
            DB::table("books_authors_relationship")->insert(["book_id"=>$ID_Book,"author_id"=>$author2_id]);
        }
        else
        {
            DB::table("books_authors_relationship")->insert(["book_id"=>$ID_Book,"author_id"=>$author_id]);
        }
        });
        $section_id=$request->section_id;
        return redirect('library/'.$section_id);

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
        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_description=$request->book_description;
        $section_id=$request->section_id;
        DB::table("books")
            ->where("id",$id)
            ->update(["book_title"=>$book_title,"book_edition"=>$book_edition,"book_description"=>$book_description]);
        return redirect("library/".$section_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        $section_id=$request->section_id;
        DB::table("books")->where("id",$id)->delete();
        return redirect("library/".$section_id);

    }
    public function admin(){
        $date=date('Y-m-d');
        $time=date('H-i-s');

        // $sections=DB::table('sections')->get();
        $section=Section::withTrashed()->get();
        return view('/admin',compact('section','date','time'));
    }
    public function summary()
    {
        $date=date('Y-m-d');
        $time=date('H-i-s');
        $results=Book::with('section')->with('authors')->get();
        return view("summary",compact('results',$results,'date','time'));
    }
}
