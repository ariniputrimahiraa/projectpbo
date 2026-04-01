<?php
require_once 'pembayaran.php';
require_once 'cetak.php';

class TransferBank extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Transfer Bank sebesar Rp {$this->jumlah}";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk Transfer Bank: Rp {$this->jumlah}";
    }
}
?>