<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Laravel PHP Framework</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
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
                <li><a href="{{URL::route('create_album_form')}}">Create New Album</a></li>
            </ul>
        </div><!--/.nav-collapse -->
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
        <form name="addimagetoalbum" method="POST" action="{{URL::route('add_image_to_album')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="album_id" value="{{$album->id}}" />
            <fieldset>
                <legend>Add an Image to {{$album->name}}</legend>
                <div class="form-group">
                    <label for="description">Image Description</label>
                    <textarea name="description" type="text" class="form-control" placeholder="Imagedescription"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Select an Image</label>
                    {{Form::file('image')}}
                </div>
                <button type="submit" class="btn btn-default">Add Image!</button>
            </fieldset>
        </form>
    </div>
</div> <!-- /container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>

</body>
</html>