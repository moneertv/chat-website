<?php
function getTitle(){
    global $title;
    if(isset($title))
    {
        echo 'lets talk | '.$title;
    }
    else{
        echo 'lets talk';
    }
}