@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('forms.post_form', [
                            'headerTitle' => __('Create Post'),
                            'routeName' => 'admin.post.store',
                            'submitButton' => __('Create'),
                ])
            </div>
        </div>
    </div>
@endsection
