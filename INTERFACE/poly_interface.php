<?php
interface PembayaranPoly {
    public function bayar($jumlah);
}

class TransferBankPoly implements PembayaranPoly {
    public function bayar($jumlah) {
        return "Transfer Rp $jumlah berhasil";
    }
}

class EwalletPoly implements PembayaranPoly {
    public function bayar($jumlah) {
        return "E-wallet Rp $jumlah berhasil";
    }
}

// POLYMORPHISM OUTPUT
$list = [
    new TransferBankPoly(),
    new EwalletPoly()
];

foreach ($list as $p) {
    echo $p->bayar(75000);
    echo "<br>";
}
?>