@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
@if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form class="form-horizontal" action="{{route('blog.update')}}" id="editBlogForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="id" value="{{@$blog->id}}" name="id">
            <div class="form-group">
            <label class="control-label col-sm-2" for="title">Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" value="{{old('title', @$blog->title)}}"
                 placeholder="Enter Title" name="title" maxlength="255">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="title">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" class="form-control" name="description" rows="4" cols="50" maxlength="65535">{{old('description', @$blog->description)}}</textarea>
            </div>
            </div>
            <div class="form-group">
                <div class="table-responsive">  
                    <table class="table table-bordered" id="dynamic_field">  
                        <?php
                                $tags=json_decode($blog->tags);
                                
                            ?> 
                        @foreach($tags as $key=>$val)
                        <tr  id="row{{$key}}"> 
                            <td >
                                <input type="text" name="tags[]" value="{{$val}}" placeholder="Enter Blog Tag" class="form-control name_list"/>
                            </td>  
                            @if($key != array_key_first($tags))
                            <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>
                            @endif
                        </tr> 
                        @endforeach 
                        <tr><td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                        </td></tr>
                    </table>  
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="image">Blog Image:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <img src="{{url('storage/uploads').'/'.@$blog->image}}" height="100" width="100">
            </div>
            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){    
        var i=1;  
 
        $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="tags[]" placeholder="Enter Blog Tag" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      jQuery.validator.addMethod("checksize", function (val, element) {

        var size = element.files[0].size/1024;
        iSize = (Math.round(size * 100) / 100)
        if (size > 100)// checks the file more than 1 kbs
        {
            return false;
        } else {
            
            return true;
        }

        }, "File size should be less than 100 kbs");

     $("#editBlogForm").validate({
        rules: {
            "title": {
                required: true,
                maxlength: 255
            },
            "description": {
                required: true,
                maxlength: 65535

            },
            "image":{
                checksize:true

            }
        }
      });
    });
</script>
@endsection