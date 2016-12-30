<?php

/*
|--------------------------------------------------------------------------
| Module Events
|--------------------------------------------------------------------------
|
| Here is where you can register all of the Events for the module.
*/
Event::listen('backend.menu', function($user) {
    if ($user->hasRole('administrator')) {
        $items = array(
            array(
                'uri'    => 'admin/games',
                'title'  => __d('games', 'Games'),
                'label'  => '',
                'icon'   => 'cubes',
                'weight' => 1,
            )
        );
    } else {
        $items = array();
    }

    return $items;
});
