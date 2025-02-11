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

            $pendidikan = $_POST['pendidikan'];
            $lokasi = $_POST['lokasi'];
            $tahun = $_POST['tahun'];

            $sql = "INSERT INTO pendidikan (pendidikan, lokasi, tahun) VALUES ('$pendidikan', '$lokasi', '$tahun')";

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

            $pendidikan = $_POST['pendidikan'];
            $lokasi = $_POST['lokasi'];
            $tahun = $_POST['tahun'];

            $sql = "UPDATE pendidikan SET pendidikan='$pendidikan', lokasi='$lokasi', tahun='$tahun' WHERE id='$id'";

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

        $sql = "DELETE FROM pendidikan WHERE id='$id'";
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
