<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<!-- Tambahkan tombol atau link ke halaman register -->
<p>Belum punya akun? 
    <a href="{{ route('register') }}">Daftar sebagai Siswa</a>
</p>