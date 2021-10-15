@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('forms.user_form', [
                            'headerTitle' => __('Register'),
                            'routeName' => 'register',
                            'submitButton' => __('Register'),
                ])
            </div>
        </div>
    </div>
@endsection
