<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMPKITA</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <script>
    function toggleMobileMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
    function showModal(id) {
      document.getElementById(id + '-modal').classList.remove('hidden');
      if (id === 'calendar') {
        generateCalendar(currentYear);
      }
    }
    function hideModal(id) {
      document.getElementById(id + '-modal').classList.add('hidden');
    }

    let currentYear = 2025;
    const events = {
      '2025-01-15': 'Rapat Tahunan',
      '2025-02-28': 'Deadline Proyek A',
      '2025-03-10': 'Training Karyawan',
      '2025-04-20': 'Evaluasi Kinerja',
      '2025-05-01': 'Libur Lebaran',
      '2025-05-02': 'Libur Lebaran',
      '2025-05-03': 'Libur Lebaran',
      '2025-06-15': 'Seminar Teknologi',
      '2025-07-30': 'Review Proyek',
      '2025-08-20': 'Acara Team Building',
      '2025-09-25': 'Deadline Proyek B',
      '2025-10-10': 'Konferensi Industri',
      '2025-11-15': 'Rapat Strategi',
      '2025-12-25': 'Natal',
      '2025-12-31': 'Tahun Baru',
      '2026-01-10': 'Perencanaan Tahunan',
      '2026-02-14': 'Launch Produk Baru',
      '2026-03-20': 'Audit Internal',
      '2026-04-05': 'Workshop Inovasi',
      '2026-05-15': 'Libur Idul Fitri',
      '2026-05-16': 'Libur Idul Fitri',
      '2026-05-17': 'Libur Idul Fitri',
      '2026-06-30': 'Deadline Proyek C',
      '2026-08-15': 'Rapat Mid-Year',
      '2026-09-10': 'Training Advanced',
      '2026-10-20': 'Konferensi Global',
      '2026-11-25': 'Review Tahunan'
    };

    function generateCalendar(year) {
      const container = document.getElementById('calendar-container');
      container.innerHTML = '';
      const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      const daysOfWeek = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

      for (let month = 0; month < 12; month++) {
        const monthDiv = document.createElement('div');
        monthDiv.className = 'bg-white border rounded-lg p-4 shadow-md';

        const monthHeader = document.createElement('h4');
        monthHeader.className = 'text-lg font-bold mb-2 text-center';
        monthHeader.textContent = `${months[month]} ${year}`;
        monthDiv.appendChild(monthHeader);

        const daysHeader = document.createElement('div');
        daysHeader.className = 'grid grid-cols-7 gap-1 mb-2';
        daysOfWeek.forEach(day => {
          const dayDiv = document.createElement('div');
          dayDiv.className = 'text-center font-semibold text-sm';
          dayDiv.textContent = day;
          daysHeader.appendChild(dayDiv);
        });
        monthDiv.appendChild(daysHeader);

        const daysGrid = document.createElement('div');
        daysGrid.className = 'grid grid-cols-7 gap-1';

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
          const emptyDiv = document.createElement('div');
          daysGrid.appendChild(emptyDiv);
        }

        for (let date = 1; date <= lastDate; date++) {
          const dateDiv = document.createElement('div');
          dateDiv.className = 'text-center p-1 text-sm border rounded';
          dateDiv.textContent = date;

          const eventKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
          if (events[eventKey]) {
            dateDiv.className += ' bg-blue-200 font-bold';
            dateDiv.title = events[eventKey];
          }

          daysGrid.appendChild(dateDiv);
        }

        monthDiv.appendChild(daysGrid);
        container.appendChild(monthDiv);
      }
    }

    function prevYear() {
      currentYear--;
      document.getElementById('current-year').textContent = currentYear;
      generateCalendar(currentYear);
    }

    function nextYear() {
      currentYear++;
      document.getElementById('current-year').textContent = currentYear;
      generateCalendar(currentYear);
    }

    // Settings functionality
    function loadSettings() {
      const theme = localStorage.getItem('theme') || 'light';
      const language = localStorage.getItem('language') || 'id';
      const notifications = localStorage.getItem('notifications') === 'true';

      document.getElementById('theme-select').value = theme;
      document.getElementById('language-select').value = language;
      document.getElementById('notifications-checkbox').checked = notifications;

      applyTheme(theme);
      applyLanguage(language);
    }

    function applySettings() {
      const theme = document.getElementById('theme-select').value;
      const language = document.getElementById('language-select').value;
      const notifications = document.getElementById('notifications-checkbox').checked;

      localStorage.setItem('theme', theme);
      localStorage.setItem('language', language);
      localStorage.setItem('notifications', notifications);

      applyTheme(theme);
      applyLanguage(language);

      hideModal('settings');
      alert('Pengaturan berhasil disimpan!');
    }

    function applyTheme(theme) {
      const body = document.body;
      const navbar = document.querySelector('nav');
      const main = document.querySelector('main');
      const modals = document.querySelectorAll('.modal-content');

      if (theme === 'dark') {
        body.classList.add('dark');
        body.classList.remove('bg-gray-100');
        body.classList.add('bg-gray-900', 'text-gray-100');

        // Navbar dark mode
        navbar.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-blue-800');
        navbar.classList.add('bg-gradient-to-r', 'from-gray-800', 'to-gray-900');

        // Main content dark mode
        main.classList.add('text-gray-100');

        // Table dark mode
        const table = document.querySelector('table');
        if (table) {
          table.classList.add('text-gray-100');
          const tbody = table.querySelector('tbody');
          if (tbody) {
            tbody.classList.add('bg-gray-800');
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
              row.classList.add('hover:bg-gray-700');
            });
          }
        }

        // Modals dark mode
        modals.forEach(modal => {
          modal.classList.add('bg-gray-800', 'text-gray-100');
        });

        // Specific modal backgrounds
        const modalBodies = document.querySelectorAll('#team-modal, #projects-modal, #calendar-modal, #profile-modal, #settings-modal, #logout-modal');
        modalBodies.forEach(modal => {
          const content = modal.querySelector('div.bg-white');
          if (content) {
            content.classList.remove('bg-white', 'shadow-2xl');
            content.classList.add('bg-gray-800', 'text-gray-100', 'border', 'border-gray-600', 'shadow-xl');
          }
          // Adjust backdrop for better dark mode appearance
          modal.classList.remove('bg-black', 'bg-opacity-50');
          modal.classList.add('bg-gray-900', 'bg-opacity-70');
        });

        // Calendar specific
        const calendarContainer = document.getElementById('calendar-container');
        if (calendarContainer) {
          const months = calendarContainer.querySelectorAll('div');
          months.forEach(month => {
            month.classList.remove('bg-white');
            month.classList.add('bg-gray-700');
          });
        }

      } else {
        body.classList.remove('dark');
        body.classList.remove('bg-gray-900', 'text-gray-100');
        body.classList.add('bg-gray-100');

        // Reset navbar
        navbar.classList.remove('bg-gradient-to-r', 'from-gray-800', 'to-gray-900');
        navbar.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-blue-800');

        // Reset main content
        main.classList.remove('text-gray-100');

        // Reset table
        const table = document.querySelector('table');
        if (table) {
          table.classList.remove('text-gray-100');
          const tbody = table.querySelector('tbody');
          if (tbody) {
            tbody.classList.remove('bg-gray-800');
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
              row.classList.remove('hover:bg-gray-700');
            });
          }
        }

        // Reset modals
        modals.forEach(modal => {
          modal.classList.remove('bg-gray-800', 'text-gray-100');
        });

        // Reset specific modal backgrounds
        const modalBodies = document.querySelectorAll('#team-modal, #projects-modal, #calendar-modal, #profile-modal, #settings-modal, #logout-modal');
        modalBodies.forEach(modal => {
          const content = modal.querySelector('div.bg-gray-800');
          if (content) {
            content.classList.remove('bg-gray-800', 'text-gray-100');
            content.classList.add('bg-white');
          }
        });

        // Reset calendar
        const calendarContainer = document.getElementById('calendar-container');
        if (calendarContainer) {
          const months = calendarContainer.querySelectorAll('div');
          months.forEach(month => {
            month.classList.remove('bg-gray-700');
            month.classList.add('bg-white');
          });
        }
      }
    }

    function applyLanguage(language) {
      // For now, just set the lang attribute
      document.documentElement.lang = language;
      // In a real app, you might reload or change text dynamically
    }

    // Load settings on page load
    window.onload = function() {
      loadSettings();
    };
  </script>
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-xl rounded-xl mx-4 mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <div class="flex items-center">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
            alt="Logo" class="h-8 w-auto mr-3" />
          <span class="font-bold text-lg">SIMPKITA</span>
        </div>

        <!-- Menu -->
        <div class="hidden md:flex space-x-4">
          <a href="/" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-200">Dashboard</a>
          <button onclick="showModal('team')" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-200">Data Pegawai</button>
          <button onclick="showModal('projects')" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-200">Projects</button>
          <button onclick="showModal('calendar')" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-200">Calendar</button>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button type="button" class="text-white hover:text-gray-300 focus:outline-none focus:text-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <i class="fa-solid fa-bars text-xl"></i>
          </button>
        </div>

        <!-- Right Side -->
        <div class="hidden md:flex items-center space-x-4">
          <!-- Notification Button -->
          <button type="button"
            class="rounded-full p-2 text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none transition duration-200">
            <span class="sr-only">View notifications</span>
            <i class="fa-regular fa-bell"></i>
          </button>

          <!-- Profile Dropdown -->
          <div class="relative">
            <input type="checkbox" id="profile-menu" class="hidden peer">
            <label for="profile-menu" class="flex items-center cursor-pointer rounded-full p-2 text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none transition duration-200">
              <span class="sr-only">Open user menu</span>
              <i class="fa-solid fa-user"></i>
            </label>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden peer-checked:block">
              <button onclick="showModal('profile')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</button>
              <button onclick="showModal('settings')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</button>
              <button onclick="showModal('logout')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
            </div>
          </div>
        </div>

        <!-- Mobile Right Side -->
        <div class="md:hidden flex items-center space-x-4">
          <!-- Notification Button -->
          <button type="button"
            class="rounded-full p-2 text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none transition duration-200">
            <span class="sr-only">View notifications</span>
            <i class="fa-regular fa-bell"></i>
          </button>

          <!-- Profile Dropdown -->
          <div class="relative">
            <input type="checkbox" id="profile-menu-mobile" class="hidden peer">
            <label for="profile-menu-mobile" class="flex items-center cursor-pointer rounded-full p-2 text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none transition duration-200">
              <span class="sr-only">Open user menu</span>
              <i class="fa-solid fa-user"></i>
            </label>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden peer-checked:block">
              <button onclick="showModal('profile')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</button>
              <button onclick="showModal('settings')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</button>
              <button onclick="showModal('logout')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div class="hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
          <a href="/" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition duration-200">Dashboard</a>
          <button onclick="showModal('team')" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition duration-200">Data Pegawai</button>
          <button onclick="showModal('projects')" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition duration-200">Projects</button>
          <button onclick="showModal('calendar')" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700 transition duration-200">Calendar</button>
        </div>
        <div class="pt-4 pb-3 border-t border-blue-500">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <i class="fa-solid fa-user text-blue-200"></i>
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-white">User Name</div>
              <div class="text-sm font-medium text-blue-200">user@example.com</div>
            </div>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <button onclick="showModal('profile')" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-blue-200 hover:text-white hover:bg-blue-700 transition duration-200">My Profile</button>
            <button onclick="showModal('settings')" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-blue-200 hover:text-white hover:bg-blue-700 transition duration-200">Settings</button>
            <button onclick="showModal('logout')" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-blue-200 hover:text-white hover:bg-blue-700 transition duration-200">Logout</button>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-gray-800">Data Pegawai</h2>
      <a href="/tambahdata" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">
        + Tambah Data
      </a>
    </div>

    @if(session('success'))
      <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
          <tr>
            <th class="py-4 px-6 text-left font-semibold">NIP</th>
            <th class="py-4 px-6 text-left font-semibold">Nama</th>
            <th class="py-4 px-6 text-left font-semibold">Jenis Kelamin</th>
            <th class="py-4 px-6 text-left font-semibold">Tanggal Lahir</th>
            <th class="py-4 px-6 text-left font-semibold">Tamatan</th>
            <th class="py-4 px-6 text-left font-semibold">Alamat</th>
            <th class="py-4 px-6 text-center font-semibold">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($data as $item)
            <tr class="hover:bg-gray-50 transition duration-200">
              <td class="py-4 px-6">{{ $item->nip }}</td>
              <td class="py-4 px-6">{{ $item->nama }}</td>
              <td class="py-4 px-6">{{ $item->jenis_kelamin }}</td>
              <td class="py-4 px-6">{{ $item->tll }}</td>
              <td class="py-4 px-6">{{ $item->tamatan }}</td>
              <td class="py-4 px-6">{{ $item->alamat }}</td>
              <td class="py-4 px-6 text-center">
                <div class="flex justify-center space-x-4">
                  <a href="{{ route('edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200" title="Edit">
                    <i class="fa-solid fa-pencil text-lg"></i>
                  </a>
                  <a href="#" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="text-red-600 hover:text-red-800 transition duration-200" title="Hapus">
                    <i class="fa-regular fa-trash-can text-lg"></i>
                  </a>
                </div>
                <form id="delete-form-{{ $item->id }}" action="{{ route('delete', $item->id) }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-12 px-6 text-center text-gray-500">
                <i class="fa-regular fa-folder-open text-4xl mb-4"></i>
                <p>Belum ada data pegawai.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  <!-- Modals -->
  <div id="team-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl max-w-6xl w-full mx-4 max-h-screen overflow-y-auto shadow-2xl">
      <h3 class="text-lg font-bold mb-4">Team</h3>
      <p class="mb-6 text-center text-gray-600">Berikut adalah daftar data pegawai yang terdaftar dalam sistem:</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($data as $item)
          <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
              <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
                <i class="fa-solid fa-user text-xl"></i>
              </div>
              <div>
                <h4 class="text-lg font-bold text-gray-800">{{ $item->nama }}</h4>
                <p class="text-sm text-gray-600">NIP: {{ $item->nip }}</p>
              </div>
            </div>
            <div class="space-y-2">
              <div class="flex items-center">
                <i class="fa-solid fa-venus-mars text-blue-500 mr-2"></i>
                <span class="text-sm text-gray-700">{{ $item->jenis_kelamin }}</span>
              </div>
              <div class="flex items-center">
                <i class="fa-solid fa-calendar-alt text-blue-500 mr-2"></i>
                <span class="text-sm text-gray-700">{{ $item->tll }}</span>
              </div>
              <div class="flex items-center">
                <i class="fa-solid fa-graduation-cap text-blue-500 mr-2"></i>
                <span class="text-sm text-gray-700">{{ $item->tamatan }}</span>
              </div>
              <div class="flex items-center">
                <i class="fa-solid fa-map-marker-alt text-blue-500 mr-2"></i>
                <span class="text-sm text-gray-700">{{ $item->alamat }}</span>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-12">
            <i class="fa-regular fa-folder-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada data pegawai.</p>
          </div>
        @endforelse
      </div>
      <button onclick="hideModal('team')" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tutup</button>
    </div>
  </div>
  <div id="projects-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl max-w-6xl w-full mx-4 max-h-screen overflow-y-auto shadow-2xl">
      <h3 class="text-lg font-bold mb-4">Projects</h3>
      <p class="mb-6 text-center text-gray-600">Berikut adalah daftar proyek yang sedang berjalan:</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
          <div class="flex items-center mb-4">
            <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
              <i class="fa-solid fa-mobile-screen-button text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Proyek Aplikasi Mobile</h4>
              <p class="text-sm text-gray-600">Pengembangan aplikasi mobile untuk manajemen inventaris.</p>
            </div>
          </div>
          <div class="space-y-2">
            <div class="flex items-center">
              <i class="fa-solid fa-tasks text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Status: <span class="text-yellow-600 font-semibold">Dalam pengembangan</span></span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-users text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Anggota: Ahmad, Budi, Citra</span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-calendar-check text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Deadline: 31 Desember 2025</span>
            </div>
            <div class="mt-4">
              <div class="bg-gray-200 rounded-full h-3">
                <div class="bg-yellow-500 h-3 rounded-full" style="width: 60%"></div>
              </div>
              <p class="text-xs mt-1 text-center font-semibold">Progress: 60%</p>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
          <div class="flex items-center mb-4">
            <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
              <i class="fa-solid fa-shopping-cart text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Website E-commerce</h4>
              <p class="text-sm text-gray-600">Pembuatan website penjualan online.</p>
            </div>
          </div>
          <div class="space-y-2">
            <div class="flex items-center">
              <i class="fa-solid fa-tasks text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Status: <span class="text-blue-600 font-semibold">Testing</span></span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-users text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Anggota: Dewi, Eko, Fitri</span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-calendar-check text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Deadline: 15 November 2025</span>
            </div>
            <div class="mt-4">
              <div class="bg-gray-200 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full" style="width: 80%"></div>
              </div>
              <p class="text-xs mt-1 text-center font-semibold">Progress: 80%</p>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
          <div class="flex items-center mb-4">
            <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
              <i class="fa-solid fa-cogs text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Sistem ERP</h4>
              <p class="text-sm text-gray-600">Implementasi sistem ERP untuk perusahaan.</p>
            </div>
          </div>
          <div class="space-y-2">
            <div class="flex items-center">
              <i class="fa-solid fa-tasks text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Status: <span class="text-gray-600 font-semibold">Perencanaan</span></span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-users text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Anggota: Gita, Hadi, Indra</span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-calendar-check text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Deadline: 30 Juni 2026</span>
            </div>
            <div class="mt-4">
              <div class="bg-gray-200 rounded-full h-3">
                <div class="bg-gray-500 h-3 rounded-full" style="width: 20%"></div>
              </div>
              <p class="text-xs mt-1 text-center font-semibold">Progress: 20%</p>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
          <div class="flex items-center mb-4">
            <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
              <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Aplikasi Dashboard</h4>
              <p class="text-sm text-gray-600">Dashboard analitik data.</p>
            </div>
          </div>
          <div class="space-y-2">
            <div class="flex items-center">
              <i class="fa-solid fa-tasks text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Status: <span class="text-green-600 font-semibold">Selesai</span></span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-users text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Anggota: Joko, Kiki, Lala</span>
            </div>
            <div class="flex items-center">
              <i class="fa-solid fa-calendar-check text-blue-500 mr-2"></i>
              <span class="text-sm text-gray-700">Deadline: Sudah selesai</span>
            </div>
            <div class="mt-4">
              <div class="bg-gray-200 rounded-full h-3">
                <div class="bg-green-500 h-3 rounded-full" style="width: 100%"></div>
              </div>
              <p class="text-xs mt-1 text-center font-semibold">Progress: 100%</p>
            </div>
          </div>
        </div>
      </div>
      <button onclick="hideModal('projects')" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tutup</button>
    </div>
  </div>
  <div id="calendar-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg max-w-6xl w-full mx-4 max-h-screen overflow-y-auto">
      <h3 class="text-lg font-bold mb-4 text-center">Calendar 2025-2026</h3>
      <div class="mb-4 flex justify-center">
        <button onclick="prevYear()" class="bg-blue-500 text-white px-3 py-1 rounded mr-2 hover:bg-blue-600"><</button>
        <span id="current-year" class="text-xl font-semibold">2025</span>
        <button onclick="nextYear()" class="bg-blue-500 text-white px-3 py-1 rounded ml-2 hover:bg-blue-600">></button>
      </div>
      <div id="calendar-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <!-- Calendar months will be generated here -->
      </div>
      <button onclick="hideModal('calendar')" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tutup</button>
    </div>
  </div>

  <div id="profile-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl max-w-md w-full mx-4 shadow-2xl">
      <h3 class="text-lg font-bold mb-4">My Profile</h3>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nama</label>
          <p class="mt-1 text-sm text-gray-900">User Name</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <p class="mt-1 text-sm text-gray-900">user@example.com</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Role</label>
          <p class="mt-1 text-sm text-gray-900">Administrator</p>
        </div>
      </div>
      <button onclick="hideModal('profile')" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tutup</button>
    </div>
  </div>

  <div id="settings-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl max-w-md w-full mx-4 shadow-2xl">
      <h3 class="text-lg font-bold mb-4">Settings</h3>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Tema</label>
          <select id="theme-select" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="light">Terang</option>
            <option value="dark">Gelap</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Bahasa</label>
          <select id="language-select" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="id">Indonesia</option>
            <option value="en">English</option>
          </select>
        </div>
        <div class="flex items-center">
          <input type="checkbox" id="notifications-checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
          <label for="notifications-checkbox" class="ml-2 block text-sm text-gray-900">Aktifkan Notifikasi</label>
        </div>
      </div>
      <div class="flex justify-end space-x-4 mt-4">
        <button onclick="hideModal('settings')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
        <button onclick="applySettings()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">OK</button>
      </div>
    </div>
  </div>

  <div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl max-w-sm w-full mx-4 shadow-2xl">
      <h3 class="text-lg font-bold mb-4">Konfirmasi Logout</h3>
      <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari akun?</p>
      <div class="flex justify-end space-x-4">
        <button onclick="hideModal('logout')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
        <a href="/logout" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
      </div>
    </div>
  </div>

</body>

</html>
