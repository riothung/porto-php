<?php

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : '';

require '../db.php';
$conn = OpenCon();

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

switch ($action) {
        // case 'add':
        //     /* tambah gambar */
        //     $nama = $_POST['nama'];
        //     $umur = $_POST['umur'];
        //     $telepon = $_POST['telepon'];
        //     $email = $_POST['email'];
        //     $instagram = $_POST['instagram'];
        //     $tiktok = $_POST['tiktok'];
        //     $deskripsi = $_POST['deskripsi'];
        //     $gambar = $_FILES['gambar'];
        //     // echo json_encode($gambar);
        //     $target_dir = "../assets/img/gallery/";
        //     $random_string = uniqid();
        //     $target_file = $target_dir . $random_string . '.' . pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        //     $gambarFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        //     $size_gambar = isset($_FILES['gambar']['size']);

        //     if (!move_uploaded_file($gambar["tmp_name"], $target_file)) {
        //         // handle the error
        //         die('Error moving file.');
        //     }

        //     $basename = basename($target_file);
        //     $imagePath = 'assets/img/gallery/' . $basename;

        //     $sql = "INSERT INTO profil (nama, umur, telepon, email, instagram, tiktok, deskripsi, gambar) VALUES ('$nama', '$umur', '$telepon', '$email', '$instagram', '$tiktok', '$deskripsi', '$imagePath')";

        //     try {
        //         if ($gambar == null) {
        //             if ($size_gambar > 5000000) {
        //                 echo '<div class="alert alert-warning mt-2 text-center" role="alert">
        //                         Ukuran gambar terlalu besar dari 5mb
        //                     </div>';
        //             } else {
        //                 if ($gambarFileType != "jpg" && $gambarFileType != "png" && $gambarFileType != "jpeg" && $gambarFileType != "gif") {
        //                     echo '<div class="alert alert-warning mt-2 text-center" role="alert">
        //                         file tidak disupport!!
        //                     </div>';
        //                 } else {
        //                     move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $new_gambar);
        //                 }
        //             }
        //         }

        //         if ($conn->query($sql) === TRUE) {
        //             echo '<div class="alert alert-success mt-2 text-center" role="alert">
        //                         Data berhasil ditambahkan
        //                     </div>';
        //             header("Location: " . $_SERVER['HTTP_REFERER']);
        //             exit();
        //         } else {
        //             echo '<div class="alert alert-danger mt-2 text-center" role="alert">
        //                         Data gagal ditambahkan
        //                     </div>';
        //         }
        //     } catch (PDOException $e) {
        //         $_SESSION['error'] = $e->getMessage();
        //         header('Location: ' . $_SERVER['HTTP_REFERER']);
        //         exit();
        //     }

        //     $conn->close();
        //     break;

    case 'edit':
        if (isset($_POST['submit']) && isset($_FILES['gambar'])) {
            $id = $_REQUEST['id'];
            $nama = $_POST['nama'];
            $umur = $_POST['umur'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];
            $instagram = $_POST['instagram'];
            $tiktok = $_POST['tiktok'];
            $deskripsi = $_POST['deskripsi'];
            $gambar = $_FILES['gambar'];
            $target_dir = "../assets/img/gallery/";

            // Generate unique filename
            $random_string = uniqid();
            $target_file = $target_dir . $random_string . '.' . pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);

            // File type validation
            $gambarFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if ($_FILES['gambar']['size'] > 5000000) {
                $_SESSION['error'] = 'Ukuran gambar terlalu besar (max 5MB)';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            if (!in_array($gambarFileType, $allowed_types)) {
                $_SESSION['error'] = 'Tipe file tidak didukung';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Move uploaded file
            if (move_uploaded_file($gambar["tmp_name"], $target_file)) {
                $basename = basename($target_file);
                $imagePath = 'assets/img/gallery/' . $basename;

                // Delete old image
                $get_old_image = $conn->query("SELECT gambar FROM profil WHERE id = $id");
                $old_image = $get_old_image->fetch_assoc();

                if (!empty($old_image['gambar'])) {
                    $old_image_path = '../' . $old_image['gambar'];
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }

                // Update database
                $sql = "UPDATE profil SET nama = '$nama', umur = '$umur', telepon = '$telepon', email = '$email', instagram = '$instagram', tiktok = '$tiktok', deskripsi = '$deskripsi', gambar = '$imagePath' WHERE id = $id";

                if ($conn->query($sql)) {
                    $_SESSION['success'] = 'Data berhasil diubah';
                } else {
                    $_SESSION['error'] = 'Gagal mengubah data';
                }
            } else {
                $_SESSION['error'] = 'Gagal mengunggah data';
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Fetch image path
            $get_image = $conn->query("SELECT gambar FROM profil WHERE id = $id");
            $image = $get_image->fetch_assoc();

            if (!empty($image['gambar'])) {
                $image_path = '../' . $image['gambar'];

                // Delete file from server
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Delete from database
            $sql = "DELETE FROM profil WHERE id = $id";

            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Data berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data';
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        break;
}
