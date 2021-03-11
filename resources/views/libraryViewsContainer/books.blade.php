@extends('master')
@section('content')

<div class="container">
<h1 style="clear:both; padding: 15px;color: white">{{$section->section_name}}</h1>

    <table class="table" style="clear: both">
        <form action="{{route('books.store')}}" method="POST" >

            {!! csrf_field() !!}
            <input type="hidden" name="section_id" value="{{$section->id}}">
            <tr>
             <td style="clear:both; padding: 5px;color: white">Enter the title of the book:</td>
                <td><input type="text" name="book_title"></td>
            </tr>
            <tr>
                <td style="clear:both; padding: 5px;color: white">Enter the edition number:</td>
                <td><input type="text" name="book_edition"></td>
            </tr>

            <tr>
                <td style="clear:both; padding: 5px;color: white">Description the book:</td>
                <td><input  name="book_description"></input></td>
            </tr>
            <tr>
                <td style="clear:both; padding: 5px;color: white">Another Author:</td>
                <td><input type="text" name="author"></td>
            </tr>

            <tr>
                <td><button  class="btn btn-success" type="submit">ADD</button></td>
            </tr>


        </form>


    </table>



    <table class="table" style="clear:both; ;margin: 15px">
        <tr>
            <th style="clear:both; padding: 15px;color: white"><h3>Book Title</h3></th>
            <th style="clear:both; padding: 15px;color: white"><h3>Book Edition</h3></th>
            <th style="clear:both; padding: 15px;color: white"><h3>Book Description</h3></th>
            <th style="clear:both; padding: 15px;color: white"><h3>Author(s)</h3></th>
            <th><h3></h3></th>
            <th><h3></h3></th>
        </tr>
        <?php $i=0;?>
        @foreach($all_books as $book)
            <tr>

                <form action="{{route('books.update',$book->id)}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PATCH"/>
                    <input type="hidden" name="section_id" value="{{$section->id}}">

                    <td>
                        <input type="text" name="book_title" value="{{$book->book_title}}">
                    </td>
                    <td>
                        <input type="text" name="book_edition" value="{{$book->book_edition}}">
                    </td>
                    <td>
                        <input name="book_description" value="{{$book->book_description}}">
                    </td>

                    <td style="clear:both; padding: 15px;color: white">
                        <?php $authors=$array_of_authors[$i];?>
                        @foreach($authors as $author)
                            <a style="color: white" href="/author/{{ $author->id }}">{{ $author->first_name }}</a>
                            @endforeach
                        <?php $i=$i+1;?>
                    </td>
                    <td>
                        <button  class="btn btn-primary" type="submit" style="margin-left: 15px">UPDATE</button>
                    </td>

                </form>

                <td  style="clear:both; padding: 15px;color: white">

                    <form action="{{route('books.destroy',$book->id)}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE"/>
                        <input type="hidden" name="section_id" value="{{$section->id}}">
                <td>
                    <button  class="btn btn-danger" type="submit" style="margin-left: 15px">DELETE</button>
                </td>

                </form>
                </td>
            </tr>
            @endforeach
    </table>
</div>



@stop