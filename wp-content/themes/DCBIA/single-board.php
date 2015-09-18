<?php

use Director\Entity\DirectorEntity;
$p = new DirectorEntity(get_the_ID());

if($p->getCategory() == "Media"){
    header('Location: /media');
}
else{
    header('Location: /about/board');
}
