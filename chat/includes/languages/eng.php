<?php    
    function lang( $phrase )
    {
        $lang = array(
            'home' => 'Home',
            'cat' => 'Categories',
            'editprof'=>'Edit Profile',
            'set'=>'Settings',
            'logout'=>'Log out',
            'items'=>'items',
            'statistics'=>'statistics'
        );
        return $lang[$phrase];
    }