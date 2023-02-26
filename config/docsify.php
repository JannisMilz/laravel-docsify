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
    'guard'      => null,
    'ga_id'      => '',
    'middleware' => [
      'web',
    ]
  ],

  /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | Here you can add configure the search functionality of your docs.
    | You can choose the default engine of your search from the list
    | However, you can also enable/disable the search's visibility
    |
    | Supported Search Engines: 'algolia', 'internal'
    |
    */

  'search' => [
    'enabled' => false,
    'index' => ['h2', 'h3']
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

  // TODO: Code color themes
  'ui' => [
    'colors' => [
      'primary' => '#787AF6',
      'secondary' => '#2b9cf2'
    ],
    'fav' => '',     // eg: fav.png
    'show_side_bar' => true,
  ],
];
