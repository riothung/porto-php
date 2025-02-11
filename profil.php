<?php
require './partials/header.php';

$sql = "SELECT * FROM profil";
$result = $conn->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// echo json_encode($data);

// Ambil data pertama (jika ada)
$row = isset($data[0]) ? $data[0] : null;

$conn->close();
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg my-5">
                <div class="card-header">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="./controllers/profilController.php?action=edit&id=<?= $row['id'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="nama" placeholder="Masukkan nama lengkap" value="<?= $row['nama'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Umur</label>
                            <input type="text" class="form-control" id="age" name="umur" placeholder="Masukkan umur" value="<?= $row['umur'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="telepon" placeholder="Masukkan nomor telepon" value="<?= $row['telepon'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= $row['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Masukkan username Instagram" value="<?= $row['instagram'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tiktok">TikTok</label>
                            <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Masukkan username TikTok" value="<?= $row['tiktok'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="deskripsi" rows="4" placeholder="Masukkan deskripsi diri Anda" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control-file" id="image" name="gambar" accept="image/*" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Edit</button>
                        <a href="./controllers/profilController.php?action=delete&id=<? $row['id'] ?>" class="btn btn-danger">Hapus</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './partials/footer.php'; ?>