<form action="/posts" method="POST">
    @csrf
    <input name="title" placeholder="Judul">
    <textarea name="content"></textarea>
    <button>Simpan</button>
</form>
