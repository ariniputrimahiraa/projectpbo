<?php
require_once 'TransferBank.php';
require_once 'Ewallet.php';
require_once 'QRIS.php';

$hasil = "";
$struk = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    if ($metode == "transfer") {
        $bayar = new TransferBank($jumlah);
    } elseif ($metode == "ewallet") {
        $bayar = new Ewallet($jumlah);
    } elseif ($metode == "qris") {
        $bayar = new QRIS($jumlah);
    }

    $hasil = $bayar->prosesPembayaran();
    $struk = $bayar->cetakStruk();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            margin: 0;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            width: 380px;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, select:focus {
            border-color: #4facfe;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4facfe, #00c6ff);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.03);
            opacity: 0.9;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            background: #f1fdf5;
            border-left: 5px solid #28a745;
        }

        .result strong {
            color: #333;
        }

        .divider {
            height: 1px;
            background: #ddd;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="card">
        <h2>💳 Pembayaran</h2>

        <form method="POST">
            <label>Jumlah (Rp)</label>
            <input type="number" name="jumlah" placeholder="Contoh: 100000" required>

            <label>Metode Pembayaran</label>
            <select name="metode" required>
                <option value="">-- Pilih Metode --</option>
                <option value="transfer">🏦 Transfer Bank</option>
                <option value="ewallet">📱 E-Wallet</option>
                <option value="qris">🔳 QRIS</option>
            </select>

            <button type="submit">Bayar Sekarang</button>
        </form>

        <?php if ($hasil != ""): ?>
            <div class="result">
                <strong>Hasil Transaksi</strong>
                <div class="divider"></div>
                <?= $hasil ?><br><br>
                <?= $struk ?>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>