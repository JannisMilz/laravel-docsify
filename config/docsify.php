<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Documentation Routes
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of the LaRecipe docs basic route
    | where you can specify the url of your documentations, the location
    | of your docs and the landing page when a user visits /docs route.
    |
    |
    */

  // TODO: Middleware
  // TODO: Landing page
  'docs'        => [
    'route'   => '/docs',
    'path'    => '/documentation',
    'default_page_title' => env("APP_NAME", "No page title provided")
  ],

  /*
    |--------------------------------------------------------------------------
    | Documentation Versions
    |--------------------------------------------------------------------------
    |
    | Here you may specify and set the versions and the default (latest) one
    | of your documentation's versions where you can redirect the user to.
    | Just make sure that the default version is in the published list.
    |
    |
    */

  // TODO: Middleware per version (authorized version e.g. Maintainers)
  'versions'      => [
    'default'   => '1.0',
    'published' => [
      '1.0'
    ]
  ],

  /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Obviously rendering markdown at the back-end is costly especially if
    | the rendered files are massive. Thankfully, caching is considered
    | as a good option to speed up your app when having high traffic.
    |
    | Caching period unit: minutes
    |
    */

  'cache'       => [
    'enabled' => false,
    'period'  => 5
  ],

  /*
    |--------------------------------------------------------------------------
    | Documentation Settings
    |--------------------------------------------------------------------------
    |
    | These options configure the additional behaviors of your documentation
    | where you can limit the access to only authenticated users in your
    | system. It is false initially so that guests can view your docs.
    | Middleware can be defined if auth is set to false. For example, if you want all users to be able to access your docs,
    | use web middleware. If you want just auth users, use auth middleware. Or, make your own middleware
    | to handle who can see your docs (don't forget to use gates for more granular control!).
    |
    |
    */

  'settings'       => [
    'auth'       => false,
    'middleware' => [
      'web',
    ]
  ],

  /*
    |--------------------------------------------------------------------------
    | Appearance
    |--------------------------------------------------------------------------
    |
    | Here you can add configure the appearance of your docs. For example,
    | you can set the primary and secondary colors that will give your
    | documentation a unique look. You can set the fav of your docs.
    |
    |
    */

  'ui'                 => [
    'default_show_side_bar'  => true,
    'colors'         => [
        'primary'    => '#787AF6',
        'secondary'  => '#2b9cf2',
        'info'       => '#03a9f4',
        'warning'    => '#fb6340',
        'success'    => '#21b978',
        'danger'     => '#f5365c'
    ],
],
];
