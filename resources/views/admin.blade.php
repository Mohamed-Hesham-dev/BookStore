<html>
<head>
    <title>library</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <style type="text/css">
        body{
            background: url("{{asset('image/bodybg.jpg')}}") no-repeat center center fixed;
            background-size: 100% auto;
        }
        header{opacity: 0.7;}
        footer{background-color: #fff;opacity: 0.9; text-align: center}
    </style>
</head>
<body>
<header class="jumbotron">
    <a href="{{route('library.index')}}" style="color: black;float: right;padding-right: 100px">library</a>
    <br>

    <a href="{{route('summary')}}" style="color: black;float: right;padding-right: 100px">Summary List</a>
    <br>
    <div class="c" style="float: left;">
        <h3 style="color: black">The BookStore!!</h3>
        <p style="color: black">Reading a good book from my site ^^</p>
    </div>
    <div class="col-md-2" style="color: black;float: right;">
        Date:{{$date}}
        <br>
        Time:{{$time}}
    </div>
</header>

 <div class="container">

     <div class="panal panal-default" style="clear: both">
         <div class="panal-heading" style="color: white;font-size: larger">Managing sections</div>

         @if(Session::has('m'))
             <div class="container">
                 <?php $a=[]; $a=session()->pull('m'); ?>
                 <div class="alert alert-{{$a[0]}}" style="color: black;font-size:medium;">
                     {{$a[1]}}
                 </div>
             </div>

         @endif
         <div class="panal-body" >
             <h2 style="color: white;"><br/>create new section</h2>

             <!--create new section-->
             <form action="library" method="POST" enctype="multipart/form-data">
                 {!! csrf_field() !!}
                <span style="color: white;"> Enter the name of the section:<input type="text" name="section_name"></span><br>
                <span style="color: white;"> Upload an image:<input type="file" name="image"></span><br>
                 <button  class="btn btn-success" type="submit">
                    <!-- <img src="{{asset('image/9.jpg')}}" width="25px" height="25px">-->Create
                 </button>
             </form>
         </div>
         @if($section !=null)
             <table >
                <tr>
                    <th style="clear:both; padding: 15px;color: white"><h3>Section Name</h3></th>
                    <th style="clear:both; padding: 15px;color: white"><h3>Total Books</h3></th>
                    <th style="clear:both; padding: 15px;color: white"><h3>Update</h3></th>
                    <th style="clear:both; padding: 15px;color: white"><h3 style="padding: 10px">Delete</h3></th>
                    <th style="clear:both; padding: 15px;color: white"><h3>Restore Data</h3></th>
                </tr>
             @foreach($section as $section)
                 @if($section->trashed())
                         <tr style="background-color: red ">
                             @else
                         <tr style="background-color: #fff ">
                             @endif
                    <form action="library/{{$section->id}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <td>
                            <input type="text" name="section_name" value="{{$section->section_name}}">
                        </td>
                        <td>
                            <input type="text" name="books_total" value="{{$section->books_total}}">
                        </td>
                        <td>
                            <button  class="btn btn-primary" type="submit" style="margin-left: 15px">
                                UPDATE
                            </button>
                        </td>

                    </form>

                             @if($section->trashed())
                                 <td style="padding: 10px">
                                 <form action="delete-forever/{{$section->id}}" method="POST">
                                     {!! csrf_field() !!}
                                     <button  class="btn btn-warning" type="submit" style="margin-top: 10px">
                                         Delete-Forever
                                     </button>
                                 </form>
                             </td>

                                 @else
                    <td style="padding: 10px">
                        <form action="library/{{$section->id}}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button  class="btn btn-danger" type="submit" style="margin-top: 15px">
                                DELETE
                            </button>
                    </form>
                    </td>
                                 <td>
                                     <a class="btn btn-info"href="library/{{$section->id}}">SHOW</a>
                                 </td>
                             @endif

                             @if($section->trashed())
                                 <span width="15px" >
                                 <td>
                                         <form action="restore/{{$section->id}}" method="POST">
                                         {!! csrf_field() !!}
                                     <button  class="btn btn-primary" type="submit" style="margin-top: 10px">
                                        Restore Data
                                     </button>
                                 </form>
                                 </td>
                                 </span>
                                 @endif


                </tr>
                @endforeach
             </table>
             @endif
     </div>
 </div>
</body>
</html>