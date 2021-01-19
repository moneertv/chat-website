<?php    
    function lang( $phrase )
    {
        $lang = array(
            'message' => 'مرحبا بك',
            'admin' => 'المدير'
        );
        return $lang[$phrase];
    }