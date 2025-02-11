<?php
session_start();
// Check for the action parameter in the URL or form submission
$action = isset($_GET['action']) ? $_GET['action'] : '';

require '../db.php';
$conn = OpenCon();

// Handle different actions
switch ($action) {
    case 'add':
        if (isset($_POST['submit'])) {

            $pengalaman = $_POST['pengalaman'];
            $tahun = $_POST['tahun'];
            $kategori = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];

            $sql = "INSERT INTO pengalaman (pengalaman, kategori, tahun, deskripsi) VALUES ('$pengalaman', '$kategori', '$tahun', '$deskripsi')";

            try {
                $result = $conn->query($sql);
                $_SESSION['success-alert'] = 'Berhasil menambah data';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } catch (PDOException $e) {
                echo json_encode($e);
                $_SESSION['failed-alert'] = 'Gagal menambah data';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        $conn->close();
        break;

    case 'edit':
        if (isset($_POST['submit'])) {

            $id = $_POST['id'];

            $pengalaman = $_POST['pengalaman'];
            $kategori = $_POST['kategori'];
            $tahun = $_POST['tahun'];
            $deskripsi = $_POST['deskripsi'];

            $sql = "UPDATE pengalaman SET pengalaman='$pengalaman', tahun='$tahun', kategori='$kategori', deskripsi='$deskripsi'   WHERE id='$id'";

            try {
                $result = $conn->query($sql);
                $_SESSION['success-alert'] = 'Berhasil mengubah data';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } catch (PDOException $e) {
                $_SESSION['failed-alert'] = 'Gagal mengubah data';
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        $conn->close();
        break;

    case 'delete':

        $id = $_GET['id'];
        $sql = "DELETE FROM pengalaman WHERE id='$id'";
        try {
            $result = $conn->query($sql);
            $_SESSION['success-alert'] = 'Berhasil menghapus data';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed-alert'] = 'Gagal menghapus data';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $conn->close();

        break;

    default:
        // Default action or error handling
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
        break;
}
