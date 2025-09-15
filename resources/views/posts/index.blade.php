<h1>All Posts</h1>
<a href="{{ route('posts.create') }}">Create New</a>
<ul>
@foreach($posts as $post)
    <li>
        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        &nbsp;
        <a href="{{ route('posts.show', $post) }}">{{ $post->content }}</a>

        <a href="{{ route('posts.edit', $post) }}">Edit</a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>

