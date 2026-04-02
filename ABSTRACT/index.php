<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #6c8cff;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            background: #f8f9fb;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pembayaran</h2>

    <form method="POST">
        <label>Jumlah Pembayaran</label>
        <input type="number" name="jumlah" required>

        <label>Diskon (%)</label>
        <input type="number" name="diskon" placeholder="contoh: 10">

        <label>Metode Pembayaran</label>
        <select name="metode" required>
            <option value="">-- Pilih Metode --</option>
            <option value="transfer">Transfer Bank</option>
            <option value="ewallet">E-Wallet</option>
            <option value="qris">QRIS</option>
            <option value="cod">COD</option>
            <option value="va">Virtual Account</option>
        </select>

        <button type="submit" name="proses">Proses Pembayaran</button>
    </form>

<?php
if(isset($_POST['proses'])) {

    require_once 'transferbank.php';
    require_once 'ewallet.php';
    require_once 'qris.php';
    require_once 'cod.php';
    require_once 'va.php';

    $jumlah = $_POST['jumlah'];
    $diskon = isset($_POST['diskon']) ? $_POST['diskon'] : 0;
    $metode = $_POST['metode'];

    // hitung diskon
    $potongan = ($diskon / 100) * $jumlah;
    $setelahDiskon = $jumlah - $potongan;

    // pajak 11%
    $pajak = 0.11 * $setelahDiskon;

    // total akhir
    $total = $setelahDiskon + $pajak;

    // pilih metode
    if($metode == "transfer") {
        $obj = new TransferBank($total);
    } elseif($metode == "ewallet") {
        $obj = new Ewallet($total);
    } elseif($metode == "qris") {
        $obj = new Qris($total);
    } elseif($metode == "cod") {
        $obj = new COD($total);
    } elseif($metode == "va") {
        $obj = new VA($total);
    }

    echo "<div class='result'>";
    echo "<b>Detail Pembayaran</b><br><br>";
    echo "Jumlah Awal: Rp $jumlah <br>";
    echo "Diskon: $diskon% (-Rp $potongan)<br>";
    echo "Setelah Diskon: Rp $setelahDiskon <br>";
    echo "Pajak 11%: Rp $pajak <br>";
    echo "<hr>";
    echo "<b>Total Bayar: Rp $total</b><br><br>";
    echo $obj->prosesPembayaran();
    echo "<br>";
    echo $obj->cetakStruk();
    echo "</div>";
}
?>

</div>

</body>
</html>