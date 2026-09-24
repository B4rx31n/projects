<?php
session_start();
include '../config/db.php';
if(!isset($_SESSION['login'])) header('Location: ../login.php');

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['add'])){
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $pekerjaan = mysqli_real_escape_string($conn,$_POST['pekerjaan']);
    $penghasilan = mysqli_real_escape_string($conn,$_POST['penghasilan']);
    mysqli_query($conn, "INSERT INTO data_pekerjaan (nama,pekerjaan,penghasilan) VALUES('$nama','$pekerjaan','$penghasilan')");
  } elseif(isset($_POST['edit'])){
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $pekerjaan = mysqli_real_escape_string($conn,$_POST['pekerjaan']);
    $penghasilan = mysqli_real_escape_string($conn,$_POST['penghasilan']);
    mysqli_query($conn, "UPDATE data_pekerjaan SET nama='$nama',pekerjaan='$pekerjaan',penghasilan='$penghasilan' WHERE id=$id");
  }
}

if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM data_pekerjaan WHERE id=$id");
  header('Location: data_pekerjaan.php');
  exit;
}

$res = mysqli_query($conn, "SELECT * FROM data_pekerjaan ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Data Pekerjaan</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container">
  <h2 class="section-title">Data Pekerjaan</h2>
  <div style="margin:18px 0">
    <form method="post" style="display:flex;gap:8px;flex-wrap:wrap">
      <input name="nama" placeholder="Nama" required>
      <input name="pekerjaan" placeholder="Pekerjaan" required>
      <input name="penghasilan" placeholder="Penghasilan" required>
      <button class="btn" name="add" type="submit">Tambah</button>
    </form>
  </div>

  <table class="table">
    <thead><tr><th>#</th><th>Nama</th><th>Pekerjaan</th><th>Penghasilan</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php $i=1; while($row=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo htmlspecialchars($row['nama']); ?></td>
        <td><?php echo htmlspecialchars($row['pekerjaan']); ?></td>
        <td><?php echo htmlspecialchars($row['penghasilan']); ?></td>
        <td class="actions">
          <a href="data_pekerjaan.php?editform=<?php echo $row['id']; ?>">Edit</a>
          <a href="data_pekerjaan.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php
  if(isset($_GET['editform'])){
    $id = (int)$_GET['editform'];
    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data_pekerjaan WHERE id=$id"));
    if($r):
  ?>
  <hr>
  <h3>Edit Data</h3>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
    <input name="nama" value="<?php echo htmlspecialchars($r['nama']); ?>" required>
    <input name="pekerjaan" value="<?php echo htmlspecialchars($r['pekerjaan']); ?>" required>
    <input name="penghasilan" value="<?php echo htmlspecialchars($r['penghasilan']); ?>" required>
    <button class="btn" name="edit" type="submit">Simpan</button>
  </form>
  <?php
    endif;
  }
  ?>

</div>
</body>
</html>
