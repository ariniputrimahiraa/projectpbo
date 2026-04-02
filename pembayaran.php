<?php
abstract class Pembayaran {
    protected $jumlah;

    public function __construct($jumlah) {
        $this->jumlah = $jumlah;
    }

    // method wajib
    abstract public function prosesPembayaran();

    // validasi
    public function validasi() {
        return $this->jumlah > 0;
    }

    // HITUNG DISKON + PAJAK
    public function hitungTotal() {
        $diskon = $this->jumlah * 0.10; // 10%
        $setelahDiskon = $this->jumlah - $diskon;
        $pajak = $setelahDiskon * 0.11; // 11%

        return $setelahDiskon + $pajak;
    }
}
?>