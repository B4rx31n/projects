<?php
session_start();
include '../config/db.php';
if(!isset($_SESSION['login'])) header('Location: ../login.php');

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['add'])){
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $nik = mysqli_real_escape_string($conn,$_POST['nik']);
    $alamat = mysqli_real_escape_string($conn,$_POST['alamat']);
    mysqli_query($conn, "INSERT INTO data_nama (nama_lengkap,nik,alamat) VALUES('$nama','$nik','$alamat')");
  } elseif(isset($_POST['edit'])){
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $nik = mysqli_real_escape_string($conn,$_POST['nik']);
    $alamat = mysqli_real_escape_string($conn,$_POST['alamat']);
    mysqli_query($conn, "UPDATE data_nama SET nama_lengkap='$nama',nik='$nik',alamat='$alamat' WHERE id=$id");
  }
}

if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM data_nama WHERE id=$id");
  header('Location: data_nama.php');
  exit;
}

$res = mysqli_query($conn, "SELECT * FROM data_nama ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Data Nama</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container">
  <h2 class="section-title">Data Nama</h2>
  <div style="margin:18px 0">
    <form method="post" style="display:flex;gap:8px;flex-wrap:wrap">
      <input name="nama" placeholder="Nama Lengkap" required style="flex:1">
      <input name="nik" placeholder="NIK" required style="width:160px">
      <input name="alamat" placeholder="Alamat" required style="flex:1">
      <button class="btn" name="add" type="submit">Tambah</button>
    </form>
  </div>

  <table class="table">
    <thead><tr><th>#</th><th>Nama</th><th>NIK</th><th>Alamat</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php $i=1; while($row=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
        <td><?php echo htmlspecialchars($row['nik']); ?></td>
        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
        <td class="actions">
          <a href="data_nama.php?editform=<?php echo $row['id']; ?>">Edit</a>
          <a href="data_nama.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php
  if(isset($_GET['editform'])){
    $id = (int)$_GET['editform'];
    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data_nama WHERE id=$id"));
    if($r):
  ?>
  <hr>
  <h3>Edit Data</h3>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
    <input name="nama" value="<?php echo htmlspecialchars($r['nama_lengkap']); ?>" required style="flex:1">
    <input name="nik" value="<?php echo htmlspecialchars($r['nik']); ?>" required style="width:160px">
    <input name="alamat" value="<?php echo htmlspecialchars($r['alamat']); ?>" required style="flex:1">
    <button class="btn" name="edit" type="submit">Simpan</button>
  </form>
  <?php
    endif;
  }
  ?>

</div>
</body>
</html>
