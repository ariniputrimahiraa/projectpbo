<?php
require_once 'pembayaran.php';
require_once 'cetak.php';

class COD extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran COD Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk COD: Rp {$this->jumlah}";
    }
}
?>