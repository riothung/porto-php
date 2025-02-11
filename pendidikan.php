<?php
require './partials/header.php';

// Ambil data pendidikan dari database
$sql = "SELECT * FROM pendidikan";
$result = $conn->query($sql);

$pendidikanList = [];

if ($result->num_rows > 0) {
    // Ambil semua data pendidikan dan masukkan ke dalam array
    while($row = $result->fetch_assoc()) {
        $pendidikanList[] = $row;
    }
}

// Cek apakah ada data yang dikirim melalui POST untuk tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['education'], $_POST['location'], $_POST['year'])) {
        $education = $_POST['education'];
        $location = $_POST['location'];
        $year = $_POST['year'];

        // Menambahkan data ke database
        $sqlInsert = "INSERT INTO pendidikan (pendidikan, lokasi, tahun) VALUES ('$education', '$location', '$year')";
        $conn->query($sqlInsert);
        
        // Reload data setelah menambah data
        header("Location: pendidikan.php");
        exit();
    }
}

// Cek apakah ada data yang perlu dihapus
if (isset($_GET['delete'])) {
    $indexToDelete = $_GET['delete'];
    // Hapus data dari database
    $sqlDelete = "DELETE FROM pendidikan WHERE id = $indexToDelete";
    $conn->query($sqlDelete);
    
    // Reload data setelah menghapus data
    header("Location: pendidikan.php");
    exit();
}

// Cek apakah ada data yang perlu diupdate
if (isset($_POST['update_education'])) {
    $id = $_POST['id'];
    $education = $_POST['update_education'];
    $location = $_POST['update_location'];
    $year = $_POST['update_year'];

    // Update data pendidikan
    $sqlUpdate = "UPDATE pendidikan SET pendidikan = '$education', lokasi = '$location', tahun = '$year' WHERE id = $id";
    $conn->query($sqlUpdate);

    // Reload data setelah update
    header("Location: pendidikan.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendidikan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg my-5">
                    <div class="card-header">
                        <h4 class="card-title">Form Pendidikan</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="education">Pendidikan</label>
                                <input type="text" class="form-control" id="education" name="education" placeholder="Masukkan nama pendidikan" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Lokasi</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Masukkan lokasi pendidikan" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="text" class="form-control" id="year" name="year" placeholder="Masukkan tahun pendidikan" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Pendidikan</button>
                        </form>

                        <div class="mt-4">
                            <h5>Data Pendidikan</h5>
                            <?php if (!empty($pendidikanList)): ?>
                                <?php foreach ($pendidikanList as $pendidikan): ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($pendidikan['pendidikan']); ?></h5>
                                            <p class="card-text">Lokasi: <?= htmlspecialchars($pendidikan['lokasi']); ?> | Tahun: <?= htmlspecialchars($pendidikan['tahun']); ?></p>
                                            <!-- Button Edit, Menggunakan modal -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $pendidikan['id']; ?>" data-education="<?= htmlspecialchars($pendidikan['pendidikan']); ?>" data-location="<?= htmlspecialchars($pendidikan['lokasi']); ?>" data-year="<?= htmlspecialchars($pendidikan['tahun']); ?>">Edit</button>
                                            <a href="?delete=<?= $pendidikan['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Tidak ada data pendidikan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pendidikan -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="update_education">Pendidikan</label>
                            <input type="text" class="form-control" id="update_education" name="update_education" required>
                        </div>
                        <div class="form-group">
                            <label for="update_location">Lokasi</label>
                            <input type="text" class="form-control" id="update_location" name="update_location" required>
                        </div>
                        <div class="form-group">
                            <label for="update_year">Tahun</label>
                            <input type="number" class="form-control" id="update_year" name="update_year" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Pendidikan</button>
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
            var education = button.data('education');
            var location = button.data('location');
            var year = button.data('year');

            // Menampilkan data di modal
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #update_education').val(education);
            modal.find('.modal-body #update_location').val(location);
            modal.find('.modal-body #update_year').val(year);
        });
    </script>

</body>
</html>

<?php require './partials/footer.php'; ?>
