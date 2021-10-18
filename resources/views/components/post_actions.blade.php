@if(!empty($withView))
    @can('view', $post)
        <span>
        <a href="{{ route('admin.post.show', ['id'=>$post->id]) }}"
           class="cursor-pointer text-70 mr-3 inline-flex items-center has-tooltip"
        >
    @include('svg.view_icon')
   </a>
    </span>
    @endcan
@endif

@can('edit', $post)
    <span class="inline-flex">
        <a href="{{ route('admin.post.edit', ['id'=>$post->id]) }}"
           class="inline-flex cursor-pointer text-70 mr-3 has-tooltip"
        >
    @include('svg.edit_icon')
        </a>
    </span>
@endcan

@can('delete', $post)
    <form action="{{ route('admin.post.delete', ['id'=>$post->id]) }}"
          method="post"
    >
        @csrf
        <input
            class="btn-danger cursor-pointer text-70 mr-3 inline-flex items-center has-tooltip"
            type="submit" value="Delete"/>
        <input type="hidden" name="_method" value="delete"/>
    </form>
@endcan
