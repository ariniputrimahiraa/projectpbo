<?php
require_once 'interface.php';
require_once 'multi_interface.php';
require_once 'poly_interface.php';

echo "<h3>Latihan Interface</h3>";
$t = new TransferBank();
$e = new Ewallet();

echo $t->bayar(100000);
echo "<br>";
echo $e->bayar(50000);

echo "<hr>";

echo "<h3>Multiple Interface</h3>";
$m = new Motor();

echo $m->hidupkan();
echo "<br>";
echo $m->berjalan();

echo "<hr>";

echo "<h3>Polymorphism</h3>";

$list = [
    new TransferBank(),
    new Ewallet()
];

foreach ($list as $p) {
    echo $p->bayar(75000);
    echo "<br>";
}
?>