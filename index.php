<?php
require_once 'transferbank.php';
require_once 'ewallet.php';
require_once 'qris.php';

// objek
$transfer = new TransferBank(7000);
$ewallet = new Ewallet(3000);
$qris = new qris(5000);


// output
echo $transfer->prosesPembayaran();
echo "<br>";
echo $transfer->cetakStruk();

echo "<hr>";

echo $ewallet->prosesPembayaran();
echo "<br>";
echo $ewallet->cetakStruk();

echo "<hr>";

echo $qris->prosesPembayaran();
echo "<br>";
echo $qris->cetakStruk();

?>