<?php
session_start();
// Hapus semua data session
session_unset();
// Hapus session
session_destroy();
// Redirect ke halaman login dengan pesan sukses
header("Location: login/login.php?message=logout_success");
exit();
