<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Create an Album</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 50px;
            background-color: #cccccc;
        }
    </style>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Albums</a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('create_album_form')}}">Create New Album</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container" style="text-align: center;">
    <div class="span4" style="display: inline-block;margin-top:100px;">

        @if ( count( $errors ) > 0 )
            <div class="alert alert-block alert-error fade in" id="error-block">
                <?php
                $messages = $errors->all(':message');
                ?>
                <button type="button" class="close" data-dismiss="alert">×</button>

                <h4>Warning!</h4>
                <ul>
                    @foreach($messages as $message)
                        {{$message}}
                    @endforeach
                </ul>
            </div>
        @endif

        <form name="createnewalbum" method="POST" action="{{route('create_album')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
                <legend>Create an Album</legend>
                <div class="form-group">
                    <label for="name">Album Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Album Name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="description">Album Description</label>
                    <textarea name="description" type="text" class="form-control" placeholder="Albumdescription">{{old('descrption')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Select a Cover Image</label>
                    {{Form::file('cover_image')}}
                </div>
                <button type="submit" class="btn btn-default">Create!</button>
            </fieldset>
        </form>
    </div>
</div>

</body>
</html>