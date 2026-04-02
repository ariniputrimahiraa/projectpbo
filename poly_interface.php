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

// polymorphism
$pembayaran = [
    new TransferBank(),
    new Ewallet()
];

foreach ($pembayaran as $p) {
    echo $p->bayar(100000);
    echo "<br>";
}
?>