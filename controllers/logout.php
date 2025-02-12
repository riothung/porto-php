<?php
session_start();  // Mulai sesi
session_unset();  // Hapus semua variabel sesi
session_destroy(); // Hancurkan sesi

// Hapus cookie sesi (opsional tetapi bisa membantu)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

header("Location: ../index.php");
exit();

?>
