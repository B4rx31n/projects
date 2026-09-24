<!DOCTYPE html>
<html>
<head>
    <title>Toko Game</title>
</head>
<body>

<h1>Toko Game</h1>

<table border="1">
@foreach ($listGame as $game)
<tr>
    <td>{{ $game['judul'] }}</td>
    <td>{{ $game['genre'] }}</td>
</tr>
@endforeach
</table>

<br>
<a href="{{ route('game.create') }}">
    <button>Tambah Game</button>
</a>


</body>
</html>
