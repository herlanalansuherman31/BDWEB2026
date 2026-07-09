<?php
session_start();

if (isset($_POST['yes'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Sesi</title>

    <style>
        /* ==========================================================================
           RESET & GLOBAL STYLES (Tema Dark Tech)
           ========================================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0b0f19; /* Gelap pekat khas tech */
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* ==========================================================================
           LOGOUT BOX CONTAINER (Glassmorphism Effect)
           ========================================================================== */
        .logout-container {
            background: rgba(17, 24, 39, 0.85); /* Semi-transparan gelap */
            padding: 40px 35px;
            border-radius: 16px;
            max-width: 450px;
            width: 90%;
            text-align: center;
            border: 1px solid rgba(35, 192, 231, 0.2); /* Border neon tipis */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6), 0 0 15px rgba(35, 192, 231, 0.05);
            backdrop-filter: blur(10px);
        }

        /* Dekoran Icon atau Tagline Atas */
        .logout-container .tagline {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: #23c0e7; /* Warna aksen utama cyan */
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .logout-container h2 {
            font-size: 1.4rem;
            color: #ffffff;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        /* ==========================================================================
           BUTTON STYLES
           ========================================================================== */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        button {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%; /* Tombol melebar fleksibel */
        }

        /* Tombol Ya (Aksen Danger/Merah Neon) */
        .btn-yes {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        .btn-yes:hover {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
            transform: translateY(-2px);
        }

        /* Tombol Tidak (Aksen Netral/Abu Menuju Putih) */
        .btn-no {
            background: rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-no:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="logout-container">
    <span class="tagline">⚠️ SECURITY NOTICE</span>
    <h2>Apakah kamu yakin ingin mengakhiri sesi ini?</h2>

    <form method="post">
        <div class="button-group">
            <button type="button" class="btn-no" onclick="handleCancel()">
                Tidak
            </button>
            <button type="submit" name="yes" class="btn-yes">
                Ya, Logout
            </button>
        </div>
    </form>
</div>

<!-- Fungsi untuk direct no sesuai halaman yang diakses -->
<script>
function handleCancel() {
    // document.referrer mencatat URL halaman terakhir sebelum user masuk ke logout.php
    if (document.referrer && document.referrer !== "") {
        window.location.href = document.referrer;
    } else {
        // Antispasifik jika user ketik langsung URL logout.php di browser (tidak dari menu mana pun)
        window.location.href = "home/index.php"; 
    }
}
</script>
</body>
</html>