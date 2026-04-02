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
            transition: 0.2s;
        }

        input:focus, select:focus {
            border-color: #6c8cff;
            outline: none;
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
            transition: 0.2s;
        }

        button:hover {
            background-color: #5a76e0;
        }

        .result {
            margin-top: 20px;
            background: #f8f9fb;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .result hr {
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pembayaran</h2>

    <form method="POST">
        <label>Jumlah Pembayaran</label>
        <input type="number" name="jumlah" required>

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
        $metode = $_POST['metode'];

        if($metode == "transfer") {
            $obj = new TransferBank($jumlah);
        } elseif($metode == "ewallet") {
            $obj = new Ewallet($jumlah);
        } elseif($metode == "qris") {
            $obj = new Qris($jumlah);
        } elseif($metode == "cod") {
            $obj = new COD($jumlah);
        } elseif($metode == "va") {
            $obj = new VA($jumlah);
        }

        echo "<div class='result'>";
        echo $obj->prosesPembayaran();
        echo "<hr>";
        echo $obj->cetakStruk();
        echo "</div>";
    }
    ?>
</div>

</body>
</html>