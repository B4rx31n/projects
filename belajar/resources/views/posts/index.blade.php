<h1>Data Post</h1>

<a href="/posts/create">Tambah</a>

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
    <a href="/posts/{{ $post->id }}/edit">Edit</a>

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Hapus</button>
    </form>
@endforeach
