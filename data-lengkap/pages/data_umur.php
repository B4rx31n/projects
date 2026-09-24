<?php
// pages/data_umur.php
session_start();
include '../config/db.php';
if(!isset($_SESSION['login'])) header('Location: ../login.php');

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['add'])){
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jk = mysqli_real_escape_string($conn,$_POST['jk']);
    mysqli_query($conn, "INSERT INTO data_umur (nama,umur,jenis_kelamin) VALUES('$nama',$umur,'$jk')");
  } elseif(isset($_POST['edit'])){
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jk = mysqli_real_escape_string($conn,$_POST['jk']);
    mysqli_query($conn, "UPDATE data_umur SET nama='$nama',umur=$umur,jenis_kelamin='$jk' WHERE id=$id");
  }
}

if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM data_umur WHERE id=$id");
  header('Location: data_umur.php');
  exit;
}

$res = mysqli_query($conn, "SELECT * FROM data_umur ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Data Umur</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container">
  <h2 class="section-title">Data Umur</h2>

  <div style="margin:18px 0">
    <form method="post" style="display:flex;gap:8px;flex-wrap:wrap">
      <input name="nama" placeholder="Nama" required>
      <input name="umur" placeholder="Umur" type="number" required style="width:110px">
      <select name="jk" required><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select>
      <button class="btn" name="add" type="submit">Tambah</button>
    </form>
  </div>

  <table class="table">
    <thead><tr><th>#</th><th>Nama</th><th>Umur</th><th>JK</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php $i=1; while($row=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo htmlspecialchars($row['nama']); ?></td>
        <td><?php echo htmlspecialchars($row['umur']); ?></td>
        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
        <td class="actions">
          <a href="data_umur.php?editform=<?php echo $row['id']; ?>">Edit</a>
          <a href="data_umur.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php
  // simple edit form
  if(isset($_GET['editform'])){
    $id = (int)$_GET['editform'];
    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data_umur WHERE id=$id"));
    if($r):
  ?>
  <hr>
  <h3>Edit Data</h3>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
    <input name="nama" value="<?php echo htmlspecialchars($r['nama']); ?>" required>
    <input name="umur" value="<?php echo htmlspecialchars($r['umur']); ?>" type="number" required style="width:110px">
    <select name="jk" required>
      <option <?php if($r['jenis_kelamin']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
      <option <?php if($r['jenis_kelamin']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
    </select>
    <button class="btn" name="edit" type="submit">Simpan</button>
  </form>
  <?php
    endif;
  }
  ?>

</div>
</body>
</html>
