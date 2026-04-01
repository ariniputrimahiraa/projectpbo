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
            font-family: Arial;
            background: #f4f6f9;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .hasil {
            margin-top: 20px;
            padding: 10px;
            background: #e9f7ef;
            border-left: 5px solid green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pembayaran</h2>

    <form method="POST">
        <label>Jumlah (Rp)</label>
        <input type="number" name="jumlah" required>

        <label>Metode Pembayaran</label>
        <select name="metode" required>
            <option value="">-- Pilih --</option>
            <option value="transfer">Transfer Bank</option>
            <option value="ewallet">E-Wallet</option>
            <option value="qris">QRIS</option>
        </select>

        <button type="submit">Bayar</button>
    </form>

    <?php if ($hasil != ""): ?>
        <div class="hasil">
            <strong>Hasil:</strong><br>
            <?= $hasil ?><br><br>
            <strong>Struk:</strong><br>
            <?= $struk ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>