<?php
require './partials/header.php';

// Ambil data pengalaman dari database
$sql = "SELECT * FROM pengalaman";
$result = $conn->query($sql);

$pengalamanList = [];

if ($result->num_rows > 0) {
    // Ambil semua data pengalaman dan masukkan ke dalam array
    while($row = $result->fetch_assoc()) {
        $pengalamanList[] = $row;
    }
}

// Cek apakah ada data yang dikirim melalui POST untuk tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Jika menambah data baru
    if (isset($_POST['pengalaman'], $_POST['tahun'], $_POST['kategori'], $_POST['deskripsi'])) {
        $pengalaman = $_POST['pengalaman'];
        $tahun = $_POST['tahun'];
        $kategori = $_POST['kategori'];
        $deskripsi = $_POST['deskripsi'];

        // Menambahkan data ke database
        $sqlInsert = "INSERT INTO pengalaman (pengalaman, tahun, kategori, deskripsi) VALUES ('$pengalaman', '$tahun', '$kategori', '$deskripsi')";
        $conn->query($sqlInsert);
        
        // Reload data setelah menambah data
        header("Location: pengalaman.php");
        exit();
    }

    // Jika melakukan update pada pengalaman
    if (isset($_POST['update_pengalaman'])) {
        $id = $_POST['id'];
        $pengalaman = $_POST['update_pengalaman'];
        $tahun = $_POST['update_tahun'];
        $kategori = $_POST['update_kategori'];
        $deskripsi = $_POST['update_deskripsi'];

        // Update data pengalaman
        $sqlUpdate = "UPDATE pengalaman SET pengalaman = '$pengalaman', tahun = '$tahun', kategori = '$kategori', deskripsi = '$deskripsi' WHERE id = $id";
        $conn->query($sqlUpdate);

        // Reload data setelah update
        header("Location: pengalaman.php");
        exit();
    }
}

// Cek apakah ada data yang perlu dihapus
if (isset($_GET['delete'])) {
    $indexToDelete = $_GET['delete'];
    // Hapus data dari database
    $sqlDelete = "DELETE FROM pengalaman WHERE id = $indexToDelete";
    $conn->query($sqlDelete);
    
    // Reload data setelah menghapus data
    header("Location: pengalaman.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengalaman</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg my-5">
                    <div class="card-header">
                        <h4 class="card-title">Form Pengalaman</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="pengalaman">Pengalaman</label>
                                <input type="text" class="form-control" id="pengalaman" name="pengalaman" placeholder="Masukkan pengalaman" required>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan tahun pengalaman" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori pengalaman" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi pengalaman" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Pengalaman</button>
                        </form>

                        <div class="mt-4">
                            <h5>Data Pengalaman</h5>
                            <?php if (!empty($pengalamanList)): ?>
                                <?php foreach ($pengalamanList as $pengalaman): ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($pengalaman['pengalaman']); ?></h5>
                                            <p class="card-text">Tahun: <?= htmlspecialchars($pengalaman['tahun']); ?> | Kategori: <?= htmlspecialchars($pengalaman['kategori']); ?></p>
                                            <p class="card-text"><?= htmlspecialchars($pengalaman['deskripsi']); ?></p>
                                            <!-- Button Edit, Menggunakan modal -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $pengalaman['id']; ?>" data-pengalaman="<?= htmlspecialchars($pengalaman['pengalaman']); ?>" data-tahun="<?= htmlspecialchars($pengalaman['tahun']); ?>" data-kategori="<?= htmlspecialchars($pengalaman['kategori']); ?>" data-deskripsi="<?= htmlspecialchars($pengalaman['deskripsi']); ?>">Edit</button>
                                            <a href="?delete=<?= $pengalaman['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Tidak ada data pengalaman.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengalaman -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengalaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="update_pengalaman">Pengalaman</label>
                            <input type="text" class="form-control" id="update_pengalaman" name="update_pengalaman" required>
                        </div>
                        <div class="form-group">
                            <label for="update_tahun">Tahun</label>
                            <input type="number" class="form-control" id="update_tahun" name="update_tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="update_kategori">Kategori</label>
                            <input type="text" class="form-control" id="update_kategori" name="update_kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="update_deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="update_deskripsi" name="update_deskripsi" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Pengalaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        // Mengisi modal dengan data yang dipilih untuk edit
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // tombol yang memicu modal
            var id = button.data('id');
            var pengalaman = button.data('pengalaman');
            var tahun = button.data('tahun');
            var kategori = button.data('kategori');
            var deskripsi = button.data('deskripsi');

            // Menampilkan data di modal
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #update_pengalaman').val(pengalaman);
            modal.find('.modal-body #update_tahun').val(tahun);
            modal.find('.modal-body #update_kategori').val(kategori);
            modal.find('.modal-body #update_deskripsi').val(deskripsi);
        });
    </script>

</body>
</html>

<?php require './partials/footer.php'; ?>
