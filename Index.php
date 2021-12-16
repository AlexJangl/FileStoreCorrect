<?php

include __DIR__.'/vendor/autoload.php';

use FileStore\IteratorFile;

function iterate(Iterator $iterator, int $kol){
    foreach($iterator as $key=>$item){
        echo($key.' = '.implode($item)).PHP_EOL;
        if ($key == $kol-1)
        {
            break;
        }
    }
}
$failIterator = new IteratorFile('data.csv');

 iterate($failIterator, 3);

