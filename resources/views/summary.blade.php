@extends('master')
@section('content')


<div class="container">
    <h1 style="clear:both; padding: 15px;color: white">Library Summary</h1>
    <table class="table" style="clear: both;color: white">
        <tr>
            <th style="width: 25%">Section Name</th>
            <th style="width: 25%">Book Title</th>
            <th style="width: 25%">Book Description</th>
            <th style="width: 25%">Author(s)</th>
        </tr>
        @foreach($results as $bookModel)
            <tr>
                <td>
                    <a style="color: white" href="/library/{{$bookModel->section->id}}">
                        <span>{{$bookModel->section->section_name}}</span>
                    </a>
                </td>
                <td>
                    {{$bookModel->book_title}}
                </td>
                <td>
                    {{$bookModel->book_description}}
                </td>
                <?php $authors=$bookModel->authors; ?>
                <td>
                    @foreach($authors as $author)
                    <a style="color: white" href="/author/{{$author->id}} ">
                        <span>{{$author->first_name}}</span>
                    </a>
                        @endforeach
                </td>
            </tr>
            @endforeach
    </table>
</div>






@stop