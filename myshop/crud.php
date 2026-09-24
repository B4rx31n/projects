<?php
session_start();

// Proses logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Redirect ke login jika belum login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'keuangan_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        // Delete transaction
        $stmt = $pdo->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
    } else {
        // Add or update transaction
        $data = [
            'tanggal' => $_POST['tanggal'],
            'jenis' => $_POST['jenis'],
            'kategori' => $_POST['kategori'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'] ?? null
        ];

        if (isset($_POST['edit_id'])) {
            // Update existing transaction
            $stmt = $pdo->prepare("UPDATE transaksi SET 
                tanggal = :tanggal, 
                jenis = :jenis, 
                kategori = :kategori, 
                jumlah = :jumlah, 
                keterangan = :keterangan 
                WHERE id = :id");
            $data['id'] = $_POST['edit_id'];
            $stmt->execute($data);
        } else {
            // Insert new transaction
            $stmt = $pdo->prepare("INSERT INTO transaksi 
                (tanggal, jenis, kategori, jumlah, keterangan) 
                VALUES (:tanggal, :jenis, :kategori, :jumlah, :keterangan)");
            $stmt->execute($data);
        }
    }
    
    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Get all transactions
$stmt = $pdo->query("SELECT * FROM transaksi ORDER BY tanggal DESC");
$transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Helper functions
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

function formatTanggal($date) {
    $months = [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    $d = date_create($date);
    return date_format($d, 'd') . ' ' . $months[date_format($d, 'n')-1] . ' ' . date_format($d, 'Y');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRUD Badan Keuangan</title>
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #e0e7ff;
      --success: #10b981;
      --success-light: #d1fae5;
      --danger: #ef4444;
      --danger-light: #fee2e2;
      --warning: #f59e0b;
      --warning-light: #fef3c7;
      --dark: #1f2937;
      --light: #f9fafb;
      --gray: #6b7280;
      --gray-light: #e5e7eb;
      --radius: 12px;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: #f3f4f6;
      color: var(--dark);
      line-height: 1.5;
      padding: 24px;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    
    .header {
      padding: 24px 32px;
      background: var(--primary);
      color: white;
    }
    
    h1 {
      font-size: 24px;
      font-weight: 600;
      margin: 0;
    }
    
    .content {
      padding: 32px;
    }
    
    .card {
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 24px;
      margin-bottom: 32px;
    }
    
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      align-items: end;
    }
    
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    label {
      font-size: 14px;
      font-weight: 500;
      color: var(--gray);
    }
    
    input, select {
      padding: 10px 12px;
      border: 1px solid var(--gray-light);
      border-radius: 8px;
      font-size: 14px;
      transition: var(--transition);
      background-color: var(--light);
    }
    
    input:focus, select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px var(--primary-light);
    }
    
    button {
      cursor: pointer;
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      transition: var(--transition);
      border: none;
      height: 40px;
    }
    
    .btn-primary {
      background: var(--primary);
      color: white;
    }
    
    .btn-primary:hover {
      background: #3a56d4;
      transform: translateY(-1px);
    }
    
    .btn-warning {
      background: var(--warning);
      color: white;
    }
    
    .btn-warning:hover {
      background: #d97706;
    }
    
    .btn-danger {
      background: var(--danger);
      color: white;
    }
    
    .btn-danger:hover {
      background: #dc2626;
    }
    
    .table-container {
      overflow-x: auto;
      border-radius: var(--radius);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }
    
    th {
      background: var(--light);
      padding: 12px 16px;
      text-align: left;
      font-weight: 500;
      color: var(--gray);
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    td {
      padding: 16px;
      border-bottom: 1px solid var(--gray-light);
      font-size: 14px;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    tr:hover {
      background: var(--primary-light);
    }
    
    .badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .badge-success {
      background: var(--success-light);
      color: var(--success);
    }
    
    .badge-danger {
      background: var(--danger-light);
      color: var(--danger);
    }
    
    .amount {
      font-weight: 600;
      font-family: 'Space Mono', monospace;
    }
    
    .action-buttons {
      display: flex;
      gap: 8px;
    }
    
    @media (max-width: 768px) {
      .content {
        padding: 16px;
      }
      
      .card {
        padding: 16px;
      }
      
      .form-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Manajemen Keuangan</h1>
    </div>
    
    <div class="content">
      <div class="card">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <?php if (isset($_GET['edit_id'])): 
            $editId = $_GET['edit_id'];
            $editStmt = $pdo->prepare("SELECT * FROM transaksi WHERE id = ?");
            $editStmt->execute([$editId]);
            $editData = $editStmt->fetch(PDO::FETCH_ASSOC);
          ?>
            <input type="hidden" name="edit_id" value="<?php echo $editId; ?>">
          <?php endif; ?>
          
          <div class="form-grid">
            <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" id="tanggal" name="tanggal" required 
                     value="<?php echo isset($editData) ? $editData['tanggal'] : date('Y-m-d'); ?>" />
            </div>
            
            <div class="form-group">
              <label for="jenis">Jenis Transaksi</label>
              <select id="jenis" name="jenis">
                <option value="Pemasukan" <?php echo (isset($editData) && $editData['jenis'] === 'Pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                <option value="Pengeluaran" <?php echo (isset($editData) && $editData['jenis'] === 'Pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="kategori">Kategori</label>
              <input type="text" id="kategori" name="kategori" placeholder="Contoh: Gaji" required 
                     value="<?php echo isset($editData) ? $editData['kategori'] : ''; ?>" />
            </div>
            
            <div class="form-group">
              <label for="jumlah">Jumlah (Rp)</label>
              <input type="number" id="jumlah" name="jumlah" placeholder="0" required 
                     value="<?php echo isset($editData) ? $editData['jumlah'] : ''; ?>" />
            </div>
            
            <div class="form-group">
              <label for="keterangan">Keterangan (Opsional)</label>
              <input type="text" id="keterangan" name="keterangan" placeholder="Catatan tambahan" 
                     value="<?php echo isset($editData) ? $editData['keterangan'] : ''; ?>" />
            </div>
            
            <button type="submit" class="btn-primary">
              <?php echo isset($editData) ? 'Update Transaksi' : 'Simpan Transaksi'; ?>
            </button>
            
            <?php if (isset($editData)): ?>
              <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-danger" style="text-decoration: none; text-align: center; line-height: 40px;">
                Batal
              </a>
            <?php endif; ?>
          </div>
        </form>
        <!-- Logout form dan tombol tambahan sejajar dan konsisten -->
        <div style="display: flex; gap: 8px; margin-top:16px;">
          <form method="POST" action="" class="logout-form" style="margin:0;">
            <button type="submit" name="logout" class="btn-danger" style="height:40px; border-radius:8px; font-size:14px; font-weight:500;">Logout</button>
          </form>
          <a href="http://www.sikeda.bukittinggikota.go.id/index.php/badan-keuangan-kota-bukittinggi-2" target="_blank" 
   class="btn-primary" 
   style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; height:40px; border-radius:8px; font-size:14px; font-weight:500; padding:0 20px;">
  < Website >
</a>
        </div>
      </div>
      
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Jenis</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($transaksi)): ?>
              <tr>
                <td colspan="6" style="text-align: center; padding: 24px; color: var(--gray)">
                  Tidak ada data transaksi. Silakan tambahkan transaksi baru.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($transaksi as $t): ?>
                <tr>
                  <td><?php echo formatTanggal($t['tanggal']); ?></td>
                  <td>
                    <span class="badge <?php echo $t['jenis'] === 'Pemasukan' ? 'badge-success' : 'badge-danger'; ?>">
                      <?php echo $t['jenis']; ?>
                    </span>
                  </td>
                  <td><?php echo $t['kategori']; ?></td>
                  <td class="amount"><?php echo formatRupiah($t['jumlah']); ?></td>
                  <td><?php echo $t['keterangan'] ?? '-'; ?></td>
                  <td>
                    <div class="action-buttons">
                      <a href="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$t['id']; ?>" class="btn-warning" style="text-decoration: none; display: inline-block; border: none; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; height: 40px; line-height: 20px;">
                        Edit
                      </a>
                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $t['id']; ?>">
                        <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>