@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex">
                    <h1 data-arx-type="heading" contenteditable="true" data-gramm_editor="false"
                        data-arx-first-level="true" class="">
                        {{$post->name}}
                    </h1>

                    <div class="ml-3 d-flex">
                        @include('components.post_actions')
                    </div>
                </div>

                @if(!empty($post->employee))
                    <div class="d-flex">
                        <p class="mr-3">Employee: </p>
                        <a href="{{ route('admin.index', ['employee_id'=>$post->employee->id])  }}">
                            {{$post->employee->name}}
                        </a>
                    </div>
                @endif

                <div class="d-flex">
                    <p class="mr-3">Category: </p>
                    <a href="{{ route('admin.index', ['category_id'=>$post->category->id])  }}">
                        {{$post->category->name}}
                    </a>
                </div>

                <img src="{{$post->image_path}}" alt="{{$post->name}}" width="600"
                     class="img-fluid">
            </div>
        </div>
    </div>
@endsection
