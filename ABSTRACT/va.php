<?php
require_once 'pembayaran.php';
require_once 'cetak.php';

class VirtualAccount extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran Virtual Account Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk Virtual Account: Rp {$this->jumlah}";
    }
}
?>