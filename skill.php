<?php
require './partials/header.php';


// Ambil data skill dari database
$sql = "SELECT * FROM skill";
$result = $conn->query($sql);

$skillList = [];

if ($result->num_rows > 0) {
    // Ambil semua data skill dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        $skillList[] = $row;
    }
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
                        <form action="./controllers/skillController.php?action=add" method="POST">
                            <div class="form-group">
                                <label for="skill">Skill</label>
                                <input type="text" class="form-control" id="skill" name="skill" placeholder="Masukkan nama skill" required>
                            </div>
                            <div class="form-group">
                                <label for="presentase">Presentase</label>
                                <input type="number" class="form-control" id="presentase" name="presentase" placeholder="Masukkan presentase kemahiran" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Skill</button>
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
                                            <a href="./controllers/skillController.php?action=delete&id=<?= $skill['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
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
                    <form action="./controllers/skillController.php?action=edit" method="POST">
                        <input type="hidden" id="skill_id" name="id">
                        <div class="form-group">
                            <label for="update_skill">Skill</label>
                            <input type="text" class="form-control" id="update_skill" name="skill" required>
                        </div>
                        <div class="form-group">
                            <label for="update_presentase">Presentase</label>
                            <input type="number" class="form-control" id="update_presentase" name="presentase" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Update Skill</button>
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
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // tombol yang memicu modal
            var id = button.data('id');
            var skill = button.data('skill');
            var presentase = button.data('presentase');

            console.log('Modal data:', {
                id,
                skill,
                presentase
            }); // Debug

            // Menampilkan data di modal
            var modal = $(this);
            modal.find('#skill_id').val(id);
            modal.find('#update_skill').val(skill);
            modal.find('#update_presentase').val(presentase);
        });
    </script>

</body>

</html>

<?php require './partials/footer.php'; ?>