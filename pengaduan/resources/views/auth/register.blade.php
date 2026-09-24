<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    
    <!-- jangan tampilkan pilihan role agar user biasa daftar sebagai siswa -->
    <!-- Jika ingin posisi terpilih default siswa, bisa pasang input hidden -->
    <input type="hidden" name="role" value="siswa">

    <button type="submit">Daftar</button>
</form>