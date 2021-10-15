@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('forms.user_form', [
                            'headerTitle' => __('Create User'),
                            'routeName' => 'admin.user.store',
                            'submitButton' => __('Create'),
                ])
            </div>
        </div>
    </div>
@endsection
