@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
        @endif
        @auth
        <a href="{{route('blog.create')}}">New Blog</a>
        @endauth
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @isset($blogs)
                @foreach($blogs as $blog)
                <tr>
                    <td>{{@$blog->title}}</td>
                    <?php $description= (strlen($blog->description) > 100) ? substr($blog->description,0,100).'...' : $blog->description; ?>
                    <td>{{$description}}</td>
                    <td><img src="{{url('storage/uploads').'/'.@$blog->image}}" height="100" width="100"></td>
                    <td><?php
                    $tags=json_decode($blog->tags);
                    $str_tags=implode(', ',$tags);
                    ?>{{$str_tags}}</td>
                    <td>{{@$blog->user->name}}</td>
                    @if(Auth::id()==$blog->user->id)
                    <td><a class="btn btn-danger" href="{{url('blog/delete/'.$blog->id)}}">Delete</a>
                    <a class="btn btn-info" href="{{url('blog/edit/'.$blog->id)}}">Edit</a></td>
                    @else
                    <td>-</td>
                    @endif
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
