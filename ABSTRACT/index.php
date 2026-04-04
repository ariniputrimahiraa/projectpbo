<?php
function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pembayaran</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: linear-gradient(135deg, #eef2f7, #e3e9f1);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .header p {
            font-size: 13px;
            color: #777;
        }

        .wrapper {
            display: flex;
            gap: 25px;
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            flex: 1;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 17px;
            color: #222;
        }

        label {
            font-size: 12px;
            color: #666;
        }

        input, select {
            width: 100%;
            padding: 11px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: 0.2s;
        }

        input:focus, select:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 2px rgba(74,108,247,0.15);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, #4a6cf7, #6c8cff);
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.02);
        }

        .struk {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            font-family: monospace;
            font-size: 13px;
            border: 1px dashed #ccc;
        }

        .center {
            text-align: center;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
        }

        .total {
            border-top: 2px dashed #000;
            margin-top: 10px;
            padding-top: 10px;
            font-weight: bold;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Sistem Pembayaran</h1>
    <p>Selamat Berbelanja</p>
</div>

<div class="wrapper">

    <!-- FORM -->
    <div class="card">
        <h2>Form Pembayaran</h2>

        <form method="POST">
            <label>Jumlah Pembayaran</label>
            <input type="number" name="jumlah" required>

            <label>Diskon (%)</label>
            <input type="number" name="diskon">

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
    </div>

    <!-- OUTPUT -->
    <div class="card">
        <h2>Struk Pembayaran</h2>

<?php
if(isset($_POST['proses'])) {

    require_once 'transferbank.php';
    require_once 'ewallet.php';
    require_once 'qris.php';
    require_once 'cod.php';
    require_once 'va.php';

    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : 0;
$diskon = isset($_POST['diskon']) ? $_POST['diskon'] : 0;
$metode = isset($_POST['metode']) ? $_POST['metode'] : '';

    $potongan = ($diskon / 100) * $jumlah;
    $setelahDiskon = $jumlah - $potongan;
    $pajak = 0.11 * $setelahDiskon;
    $total = $setelahDiskon + $pajak;

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

    echo "<div class='struk'>";

    echo "<div class='center'><b>STRUK PEMBAYARAN</b></div>";

    echo "<div class='row'><span>Jumlah</span><span>" . rupiah($jumlah) . "</span></div>";
    echo "<div class='row'><span>Diskon ($diskon%)</span><span>- " . rupiah($potongan) . "</span></div>";
    echo "<div class='row'><span>Subtotal</span><span>" . rupiah($setelahDiskon) . "</span></div>";
    echo "<div class='row'><span>Pajak 11%</span><span>" . rupiah($pajak) . "</span></div>";

    echo "<div class='row total'><span>Total</span><span>" . rupiah($total) . "</span></div>";

    echo "<br>";
    echo $obj->prosesPembayaran();
    echo "<br>";
    echo $obj->cetakStruk();

    echo "</div>";
}
?>

    </div>

</div>

</body>
</html>