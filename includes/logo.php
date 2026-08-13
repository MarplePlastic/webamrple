<?php
/* Logo oficial de Marple Chile. Va por img_src() como el resto de las
   imágenes: escrito a mano se servía el PNG aunque existiera el WebP.
   El require va acá y no en cada página porque a este include lo usa hasta
   trabaja.php, que no carga img.php. */
require_once __DIR__ . '/img.php';
?>
<img src="<?= img_src('assets/img/Logo_MARPLE-150x90.png') ?>" alt="Marple Chile — Plastic Solution"
     class="h-11 w-auto" width="150" height="90">
