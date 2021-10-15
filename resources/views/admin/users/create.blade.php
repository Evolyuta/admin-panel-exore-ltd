@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('forms.user_form', ['header_title' => __('Create User'), 'route_name' => 'admin.user.store'])
            </div>
        </div>
    </div>
@endsection
