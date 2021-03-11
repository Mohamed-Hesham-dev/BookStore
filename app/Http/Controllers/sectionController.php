<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Section;

class sectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function _construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $date=date('Y-m-d');
        $time=date('H-i-s');
       /* $sections=['C#'=>'1.jpg','PHP'=>'2.jpg','GO'=>'3.jpg','PYTHON'=>'4.pNg','VISUAL BASIC'=>'5.jpg','KOTLINE'=>'6.jpg','JAVA'=>'7.jpg','C++'=>'8.jpg'];*/
       //$sections=DB::table('sections')->get();
        $section=Section::all();
        return view('/libraryViewsContainer.library',compact('date','time','section'));
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
        $section_name=$request->input('section_name');
        $file=$request->file('image');
        $destinationpath='images';
        $filename=$file->getClientOriginalName();
        $file->move('$destinationpath','$filename');
       // DB::table('sections')->insert(['section_name'=>$section_name,'books_total'=>0,'image_name'=>$filename]);
        //Section::insert(['section_name'=>$section_name,'books_total'=>0,'image_name'=>$filename]);
         $new_section=new Section;
         $new_section->section_name=$section_name;
         $new_section->books_total=0;
         $new_section->image_name=$filename;
         $new_section->save();

         session()->push('m','success');
         session()->push('m','Section Create Successfully!');
        return redirect('library');

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
        $date=date('Y-m-d');
        $time=date('H-i-s');

        $section=Section::find($id);
       /* $all_books=DB::table('sections')
            ->join('books','sections.id','=','books.section_id')
            ->where('sections.id',$id)
            ->get();*/
       $all_books=$section->books;
       $array_of_authors=[];
       $i=0;
       foreach ($all_books as $book)
       {
           $array_of_authors=array_add($array_of_authors,$i,
              /* DB::table("books")
                ->join("books_authors_relationship","books.id","=","books_authors_relationship.book_id")
                ->join("authors","books_authors_relationship.author_id","=","authors.id")
                ->where("books.id",$book->id)
                ->select("authors.first_name","authors.id")
                ->get()*/
              $book->authors()->select("authors.first_name","authors.id")->get());
           $i++;
       }
        return view('libraryViewsContainer.books',compact('section',$section,'all_books',$all_books,'date','time','array_of_authors',$array_of_authors));
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
        $section_name=$request->input('section_name');
        //DB::table('sections')->where('id',$id)->update(['section_name'=>$section_name]);
        //Section::where('id',$id)->update(['section_name'=>$section_name]);

        $section=Section::find($id);
        $section->section_name=$section_name;
        $section->save();
        session()->push('m','success');
        session()->push('m','Section Update Successfully!');
        return redirect('admin');
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
       // DB::table('sections')->where('id',$id)->delete();

       // Section::where('id',$id)->delete();
       // $section=Section::find();
       // $section->delete();
        Section::destroy($id);
        session()->push('m','danger');
        session()->push('m','Section Deleted Temporary!');
        return redirect('admin');
    }
    public function admin(){
        $date=date('Y-m-d');
        $time=date('H-i-s');

       // $sections=DB::table('sections')->get();
        $section=Section::withTrashed()->get();
        return view('/admin',compact('section','date','time'));
    }

    public function restore($id)
    {
        $section=Section::onlyTrashed()->find($id);
        $section->restore();
        session()->push('m','info');
        session()->push('m','Section Restored Successfully!');
        return redirect('admin');
    }

    public function deleteForever($id)
    {
        $section=Section::onlyTrashed()->find($id);
        $section->forceDelete();
        session()->push('m','danger');
        session()->push('m','Section Deleted Successfully!');
        return redirect('admin');
    }
}
