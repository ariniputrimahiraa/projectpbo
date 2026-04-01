<?php
require_once 'pembayaran.php';
require_once 'cetak.php';

//Penggunaan Class EWallet
class Ewallet extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran E-Wallet Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk E-Wallet: Rp {$this->jumlah}";
    }
}
?>