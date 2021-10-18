@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('forms.post_form', [
                            'headerTitle' => !empty($post) ? __('Update Post') :  __('Create Post'),
                            'routeName' => !empty($post) ? 'admin.post.update' : 'admin.post.store',
                            'submitButton' => !empty($post) ? __('Update') : __('Create'),
                            'post' => $post ?? null,
                            'category_id' => !empty($post) ? $post->category_id : null
                ])
            </div>
        </div>
    </div>
@endsection
