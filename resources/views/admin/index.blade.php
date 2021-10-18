@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-3">

                @can('create', \App\Models\User::class)
                    <a href="{{ route('admin.user.create') }}" class="link-primary">Create Employee</a>
                @endcan

                @can('create', \App\Models\Post::class)
                    <a href="{{ route('admin.post.create') }}" class="link-primary">Create Post</a>
                @endcan

            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            @if(count($posts))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Posts') }}</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <th scope="row">{{$post->id}}</th>
                                        <td>
                                            {{$post->name}}
                                        </td>
                                        <td class="td-fit text-right pr-6 align-middle">
                                            <div class="inline-flex items-center">

                                                @can('view', $post)
                                                    <span class="inline-flex">
                                                    <a href="{{ route('admin.post.show', ['id'=>$post->id])  }}"
                                                       class="cursor-pointer text-70 mr-3 inline-flex items-center has-tooltip"
                                                    >
                                                @include('svg.view_icon')
                                               </a>
                                                </span>
                                                @endcan

                                                @can('edit', $post)
                                                    <span class="inline-flex">
                                                    <a href="#"
                                                       class="inline-flex cursor-pointer text-70 mr-3 has-tooltip"
                                                    >
                                                @include('svg.edit_icon')
                                                    </a>
                                                </span>
                                                @endcan

                                                @can('delete', $post)
                                                    <span class="inline-flex">
                                                    <a href="#"
                                                       class="inline-flex cursor-pointer text-70 mr-3 has-tooltip"
                                                    >
                                                @include('svg.delete_icon')
                                                    </a>
                                                </span>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$posts->links('vendor.pagination.bootstrap-4')}}

                        </div>
                    </div>
                </div>


            @endif
        </div>
    </div>
@endsection
