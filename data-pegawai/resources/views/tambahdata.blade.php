<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Pegawai - SIMPKITA</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <div class="flex items-center">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
            alt="Logo" class="h-8 w-auto mr-3" />
          <span class="font-bold text-lg">SIMPKITA</span>
        </div>

        <!-- Menu -->
        <div class="hidden sm:flex space-x-4">
          <a href="/" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Dashboard</a>
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Team</a>
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Projects</a>
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Calendar</a>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">
          <!-- Notification Button -->
          <button type="button"
            class="rounded-full p-2 text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
            <span class="sr-only">View notifications</span>
            <i class="fa-regular fa-bell"></i>
          </button>

          <!-- Profile Dropdown -->
          <div class="relative">
            <input type="checkbox" id="profile-menu" class="hidden peer">
            <label for="profile-menu" class="flex items-center cursor-pointer rounded-full p-2 text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
              <span class="sr-only">Open user menu</span>
              <i class="fa-solid fa-user"></i>
            </label>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden peer-checked:block">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
              <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
          <h1 class="text-2xl font-bold text-white flex items-center">
            <i class="fa-solid fa-plus mr-3"></i>
            Tambah Data Pegawai
          </h1>
        </div>

        <form action="{{ route('simpandata') }}" method="POST" class="p-6">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-id-card mr-2"></i>NIP
              </label>
              <input type="text" id="nip" name="nip" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
              @error('nip')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-user mr-2"></i>Nama
              </label>
              <input type="text" id="nama" name="nama" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
              @error('nama')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-venus-mars mr-2"></i>Jenis Kelamin
              </label>
              <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              @error('jenis_kelamin')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="tll" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-calendar mr-2"></i>Tanggal Lahir
              </label>
              <input type="date" id="tll" name="tll" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
              @error('tll')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="tamatan" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-graduation-cap mr-2"></i>Tamatan
              </label>
              <input type="text" id="tamatan" name="tamatan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
              @error('tamatan')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>

            <div class="md:col-span-2">
              <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fa-solid fa-map-marker-alt mr-2"></i>Alamat
              </label>
              <textarea id="alamat" name="alamat" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required></textarea>
              @error('alamat')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="flex justify-between items-center mt-8">
            <a href="/" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-300 flex items-center">
              <i class="fa-solid fa-arrow-left mr-2"></i>
              Kembali ke Home
            </a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
              <i class="fa-solid fa-save mr-2"></i>
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

</body>

</html>
