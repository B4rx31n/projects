<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modern Inventory System</title>
   <style>
    :root {
      --primary: #6366f1;
      --secondary: #8b5cf6;
      --background: #f8fafc;
      --text: #1e293b;
      --card-bg: rgba(255, 255, 255, 0.9);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', system-ui, sans-serif;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--text); padding: 2rem; min-height: 100vh;
    }
    h2 { color: white; margin-bottom: 1.5rem; font-weight: 600; font-size: 1.5rem; }
    .card {
      background: var(--card-bg); border-radius: 1rem; padding: 1.5rem;
      margin-bottom: 2rem; backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }
    .card:hover { transform: translateY(-2px); }
    .form-grid {
      display: grid; gap: 1.25rem;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
    input, select, button {
      padding: 0.75rem 1rem; font-size: 1rem;
      border: 1px solid #e2e8f0; border-radius: 0.75rem;
      background: white; transition: all 0.2s ease;
    }
    input:focus, select:focus {
      outline: none; border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    button {
      background: var(--primary); color: white;
      border: none; cursor: pointer; font-weight: 500;
      display: flex; align-items: center; gap: 0.5rem;
    }
    button:hover { background: #4f46e5; transform: translateY(-1px); }
    button:active { transform: translateY(0); }
    .form-buttons {
      grid-column: 1 / -1; display: flex;
      gap: 1rem; margin-top: 0.5rem;
    }
    table {
      width: 100%; border-collapse: collapse;
      margin-top: 1rem; background: white;
      border-radius: 0.75rem; overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    th, td {
      padding: 1rem; text-align: left;
      border-bottom: 1px solid #f1f5f9;
    }
    th {
      background: var(--primary); color: white; font-weight: 600;
    }
    tr:hover { background: #f8fafc; }
    .action-btn {
      padding: 0.375rem 0.75rem;
      border-radius: 0.5rem;
      font-size: 0.875rem;
      background: #ef4444; color: white; border: none; cursor: pointer;
    }
    .action-btn:hover { background: #dc2626; }
    @media (max-width: 768px) {
      body { padding: 1rem; }
      .card { padding: 1rem; }
      .form-grid { grid-template-columns: 1fr; }
      table { display: block; overflow-x: auto; }
    }

    #penerimaTable td:last-child {
      text-align: right !important;
    }
  </style>

</head>
<body>
  <h2>Form Barang</h2>
  <div class="card">
    <form id="formBarang" class="form-grid">
      @csrf
      <input type="text" id="kode" placeholder="Kode Barang" required />
      <input type="text" id="nama" placeholder="Nama Barang" required />
      <input type="number" id="jumlah" placeholder="Jumlah" required />
      <input type="text" id="merek" placeholder="Merek" required />
      <select id="keperluan" required>
        <option value="">Pilih Keperluan</option>
        <option value="Labor">Labor</option>
        <option value="Lokal">Lokal</option>
        <option value="TU">TU</option>
        <option value="Wakil">Wakil</option>
        <option value="Pustaka">Pustaka</option>
      </select>
      <select id="subKategori" style="display:none">
        <option value="">Pilih Sub</option>
      </select>
      <select id="lokasi" style="display:none">
        <option value="">Pilih Lokasi</option>
      </select>
      <div class="form-buttons">
        <button type="submit">Tambah</button>
        <button type="button" onclick="formBarang.reset(); hideSubs();">Kosongkan Form</button>
      </div>
    </form>
  </div>

  <h2>Form Penerima</h2>
  <div class="card">
    <form id="formPenerima" class="form-grid">
      @csrf
      <input type="text" id="idPenerima" placeholder="ID Penerima" required />
      <input type="text" id="namaPenerima" placeholder="Nama Penerima" required />
      <button type="submit">Tambah Penerima</button>
    </form>
  </div>

  <h2>Form Penyerahan</h2>
  <div class="card">
    <form id="formRelasi" class="form-grid">
      @csrf
      <select id="kdBrgSelect" required></select>
      <select id="idPenerimaSelect" required></select>
      <input type="date" id="tglPenyerahan" required />
      <button type="submit">Catat Penyerahan</button>
    </form>
  </div>

  <h2>Daftar Barang</h2>
  <div class="card">
    <table id="barangTable">
      <thead>
        <tr><th>Kode</th><th>Nama</th><th>Jumlah</th><th>Merek</th><th>Keperluan</th><th>Sub</th><th>Lokasi</th><th>Aksi</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <h2>Daftar Penerima</h2>
  <div class="card">
    <table id="penerimaTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Aksi</th> <!-- Kolom aksi di paling kanan -->
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <h2>Riwayat Penyerahan</h2>
  <div class="card">
    <table id="relasiTable">
      <thead>
        <tr><th>Kode Barang</th><th>Nama Barang</th><th>ID Penerima</th><th>Nama Penerima</th><th>Tanggal</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // Fungsi untuk mengambil data dari API
    async function fetchData() {
      try {
        const [barangRes, penerimaRes, penyerahanRes] = await Promise.all([
          axios.get('/api/barang'),
          axios.get('/api/penerima'),
          axios.get('/api/penyerahan')
        ]);
        
        tampilkanBarang(barangRes.data);
        tampilkanPenerima(penerimaRes.data);
        tampilkanRelasi(penyerahanRes.data);
        isiSelectBarang(barangRes.data);
        isiSelectPenerima(penerimaRes.data);
        cekKetersediaanPenyerahan(barangRes.data.length, penerimaRes.data.length);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }

    // Event listener untuk form barang
    document.getElementById('formBarang').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        kode: this.kode.value.trim(),
        nama: this.nama.value.trim(),
        jumlah: this.jumlah.value,
        merek: this.merek.value.trim(),
        keperluan: this.keperluan.value,
        sub_kategori: this.subKategori.value || null,
        lokasi: this.lokasi.value || null
      };

      try {
        const response = await axios.post('/api/barang', formData);
        fetchData();
        this.reset();
        hideSubs();
      } catch (error) {
        alert('Error: ' + (error.response?.data?.message || error.message));
      }
    });

    // Event listener untuk form penerima
    document.getElementById('formPenerima').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        id_penerima: this.idPenerima.value.trim(),
        nama: this.namaPenerima.value.trim()
      };

      try {
        const response = await axios.post('/api/penerima', formData);
        fetchData();
        this.reset();
      } catch (error) {
        alert('Error: ' + (error.response?.data?.message || error.message));
      }
    });

    // Event listener untuk form penyerahan
    document.getElementById('formRelasi').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        barang_id: this.kdBrgSelect.value,
        penerima_id: this.idPenerimaSelect.value,
        tanggal: this.tglPenyerahan.value
      };

      try {
        const response = await axios.post('/api/penyerahan', formData);
        fetchData();
        this.reset();
      } catch (error) {
        alert('Error: ' + (error.response?.data?.message || error.message));
      }
    });

    // Fungsi untuk menampilkan data barang
    function tampilkanBarang(data) {
      document.querySelector('#barangTable tbody').innerHTML = data.map(b => `
        <tr>
          <td>${b.kode}</td><td>${b.nama}</td><td>${b.jumlah}</td><td>${b.merek}</td>
          <td>${b.keperluan}</td><td>${b.sub_kategori || '-'}</td><td>${b.lokasi || '-'}</td>
          <td><button class="action-btn" onclick="hapusBarang(${b.id})">Hapus</button></td>
        </tr>
      `).join('');
    }

    // Fungsi untuk menampilkan data penerima
    function tampilkanPenerima(data) {
      document.querySelector('#penerimaTable tbody').innerHTML = data.map(p => `
        <tr>
          <td>${p.id_penerima}</td>
          <td>${p.nama}</td>
          <td><button class="action-btn" onclick="hapusPenerima(${p.id})">Hapus</button></td>
        </tr>
      `).join('');
    }

    // Fungsi untuk menampilkan data penyerahan
    function tampilkanRelasi(data) {
      document.querySelector('#relasiTable tbody').innerHTML = data.map(r => `
        <tr>
          <td>${r.barang.kode}</td>
          <td>${r.barang.nama}</td>
          <td>${r.penerima.id_penerima}</td>
          <td>${r.penerima.nama}</td>
          <td>${r.tanggal}</td>
        </tr>
      `).join('');
    }

    // Fungsi untuk mengisi select barang
    function isiSelectBarang(data) {
      document.getElementById('kdBrgSelect').innerHTML = 
        '<option value="">Pilih Barang</option>' +
        data.map(b => `<option value="${b.id}">${b.kode} - ${b.nama}</option>`).join('');
    }

    // Fungsi untuk mengisi select penerima
    function isiSelectPenerima(data) {
      document.getElementById('idPenerimaSelect').innerHTML = 
        '<option value="">Pilih Penerima</option>' +
        data.map(p => `<option value="${p.id}">${p.id_penerima} - ${p.nama}</option>`).join('');
    }

    // Fungsi untuk menghapus barang
    async function hapusBarang(id) {
      if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
        try {
          await axios.delete(`/api/barang/${id}`);
          fetchData();
        } catch (error) {
          alert('Error: ' + (error.response?.data?.message || error.message));
        }
      }
    }

    // Fungsi untuk menghapus penerima
    async function hapusPenerima(id) {
      if (confirm('Apakah Anda yakin ingin menghapus penerima ini?')) {
        try {
          await axios.delete(`/api/penerima/${id}`);
          fetchData();
        } catch (error) {
          alert('Error: ' + (error.response?.data?.message || error.message));
        }
      }
    }

    // Fungsi untuk mengecek ketersediaan penyerahan
    function cekKetersediaanPenyerahan(barangCount, penerimaCount) {
      document.querySelector('#formRelasi button[type="submit"]').disabled = 
        !(barangCount && penerimaCount);
    }

    // Fungsi untuk menyembunyikan sub kategori dan lokasi
    function hideSubs() {
      document.getElementById('subKategori').style.display = 'none';
      document.getElementById('lokasi').style.display = 'none';
    }

    // Event listener untuk keperluan
    document.getElementById('keperluan').addEventListener('change', async function() {
      const val = this.value;
      const subKategori = document.getElementById('subKategori');
      
      if (val === 'Labor' || val === 'Lokal') {
        try {
          const response = await axios.get('/api/lokasi-data');
          const lokasiData = response.data;
          
          subKategori.innerHTML = '<option value="">Pilih Sub</option>' +
            Object.keys(lokasiData[val]).map(sub => 
              `<option value="${sub}">${sub}</option>`
            ).join('');
          subKategori.style.display = 'inline';
        } catch (error) {
          console.error('Error fetching lokasi data:', error);
        }
      } else {
        hideSubs();
      }
      document.getElementById('lokasi').innerHTML = '<option value="">Pilih Lokasi</option>';
    });

    // Event listener untuk sub kategori
    document.getElementById('subKategori').addEventListener('change', async function() {
      const keperluan = document.getElementById('keperluan').value;
      const sub = this.value;
      const lokasi = document.getElementById('lokasi');
      
      if (keperluan && sub) {
        try {
          const response = await axios.get('/api/lokasi-data');
          const lokasiData = response.data;
          
          if (lokasiData[keperluan] && lokasiData[keperluan][sub]) {
            lokasi.innerHTML = '<option value="">Pilih Lokasi</option>' +
              lokasiData[keperluan][sub].map(l => 
                `<option value="${l}">${l}</option>`
              ).join('');
            lokasi.style.display = 'inline';
          } else {
            lokasi.style.display = 'none';
          }
        } catch (error) {
          console.error('Error fetching lokasi data:', error);
        }
      } else {
        lokasi.style.display = 'none';
      }
    });

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      fetchData();
      hideSubs();
    });
  </script>
</body>
</html>