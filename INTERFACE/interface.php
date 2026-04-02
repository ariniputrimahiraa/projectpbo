<?php
interface Pembayaran {
    public function bayar($jumlah);
}

class TransferBank implements Pembayaran {
    public function bayar($jumlah) {
        return "Transfer Rp $jumlah berhasil";
    }
}

class Ewallet implements Pembayaran {
    public function bayar($jumlah) {
        return "E-wallet Rp $jumlah berhasil";
    }
}

// OUTPUT
$t = new TransferBank();
$e = new Ewallet();

echo $t->bayar(100000);
echo "<br>";
echo $e->bayar(50000);
?>