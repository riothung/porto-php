<?php
require './partials/header.php';


// Ambil data skill dari database
$sql = "SELECT * FROM skill";
$result = $conn->query($sql);

$skillList = [];

if ($result->num_rows > 0) {
    // Ambil semua data skill dan masukkan ke dalam array
    while($row = $result->fetch_assoc()) {
        $skillList[] = $row;
    }
}

// Cek apakah ada data yang dikirim melalui POST untuk tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Jika menambah data baru
    if (isset($_POST['skill'], $_POST['presentase'])) {
        $skill = $_POST['skill'];
        $presentase = $_POST['presentase'];

        // Menambahkan data ke database
        $sqlInsert = "INSERT INTO skill (skill, presentase) VALUES ('$skill', '$presentase')";
        $conn->query($sqlInsert);
        
        // Reload data setelah menambah data
        header("Location: skill.php");
        exit();
    }

    // Jika melakukan update pada skill
    if (isset($_POST['update_skill'])) {
        $id = $_POST['id'];
        $skill = $_POST['update_skill'];
        $presentase = $_POST['update_presentase'];

        // Update data skill
        $sqlUpdate = "UPDATE skill SET skill = '$skill', presentase = '$presentase' WHERE id = $id";
        $conn->query($sqlUpdate);

        // Reload data setelah update
        header("Location: skill.php");
        exit();
    }
}

// Cek apakah ada data yang perlu dihapus
if (isset($_GET['delete'])) {
    $indexToDelete = $_GET['delete'];
    // Hapus data dari database
    $sqlDelete = "DELETE FROM skill WHERE id = $indexToDelete";
    $conn->query($sqlDelete);
    
    // Reload data setelah menghapus data
    header("Location: skill.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Skill</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg my-5">
                    <div class="card-header">
                        <h4 class="card-title">Form Skill</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="skill">Skill</label>
                                <input type="text" class="form-control" id="skill" name="skill" placeholder="Masukkan nama skill" required>
                            </div>
                            <div class="form-group">
                                <label for="presentase">Presentase</label>
                                <input type="number" class="form-control" id="presentase" name="presentase" placeholder="Masukkan presentase kemahiran" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Skill</button>
                        </form>

                        <div class="mt-4">
                            <h5>Data Skill</h5>
                            <?php if (!empty($skillList)): ?>
                                <?php foreach ($skillList as $skill): ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($skill['skill']); ?></h5>
                                            <p class="card-text">Presentase: <?= htmlspecialchars($skill['presentase']); ?>%</p>
                                            <!-- Button Edit, Menggunakan modal -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $skill['id']; ?>" data-skill="<?= htmlspecialchars($skill['skill']); ?>" data-presentase="<?= htmlspecialchars($skill['presentase']); ?>">Edit</button>
                                            <a href="?delete=<?= $skill['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Tidak ada data skill.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Skill -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="update_skill">Skill</label>
                            <input type="text" class="form-control" id="update_skill" name="update_skill" required>
                        </div>
                        <div class="form-group">
                            <label for="update_presentase">Presentase</label>
                            <input type="number" class="form-control" id="update_presentase" name="update_presentase" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Skill</button>
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
            var skill = button.data('skill');
            var presentase = button.data('presentase');

            // Menampilkan data di modal
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #update_skill').val(skill);
            modal.find('.modal-body #update_presentase').val(presentase);
        });
    </script>

</body>
</html>

<?php require './partials/footer.php'; ?>
