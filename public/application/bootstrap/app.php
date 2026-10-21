<?php

/**
 * @var \Concrete\Core\Application\Application $app
 */
/* @var Concrete\Core\Console\Application $console only set in CLI environment */

/*
 * ----------------------------------------------------------------------------
 * # Custom Application Handler
 *
 * You can do a lot of things in this file.
 *
 * ## Set a theme by route:
 *
 * $app->make('\Concrete\Core\Page\Theme\ThemeRouteCollection')
 *     ->setThemeByRoute('/login', 'greek_yogurt');
 *
 * ## Register a class override.
 *
 * $app->bind('helper/feed', function() {
 * 	   return new \Application\Core\CustomFeedHelper();
 * });
 *
 * $app->bind('\Concrete\Attribute\Boolean\Controller', function($app, $params) {
 * 	    return new \Application\Attribute\Boolean\Controller($params[0]);
 * });
 *
 * ## Register Events.
 *
 * Events::addListener('on_page_view', function($event) {
 * 	  $page = $event->getPageObject();
 * });
 *
 *
 * ## Register some custom MVC Routes
 *
 * Route::register('/test', function() {
 * 	  print 'This is a contrived example.';
 * });
 *
 * Route::register('/custom/view', '\My\Custom\Controller::view');
 * Route::register('/custom/add', '\My\Custom\Controller::add');
 *
 * ## Pass some route parameters
 *
 * Route::register('/test/{foo}/{bar}', function ($foo, $bar) {
 *    echo 'Here is foo: ' . $foo . ' and bar: ' . $bar;
 * });
 *
 *
 * ## Override an Asset
 *
 * \Concrete\Core\Asset\AssetList::getInstance()
 *     ->getAsset('javascript', 'jquery')
 *     ->setAssetURL('/path/to/new/jquery.js');
 *
 * or, override an asset by providing a newer version.
 *
 * use \Concrete\Core\Asset\AssetList;
 * use \Concrete\Core\Asset\Asset;
 * $al = AssetList::getInstance();
 * $al->register(
 *     'javascript', 'jquery', 'path/to/new/jquery.js',
 *     ['version' => '2.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => false, 'combine' => false]
 * );
 *
 * ----------------------------------------------------------------------------
 */

\Events::addListener('on_theme_install', function($event) use ($app) {
    $themeName = $app->make('helper/text')->camelcase($event->getArgument('theme_handle'));
    $pkgHandle = $event->getArgument('pkg_handle');

    if ($pkgHandle) {
        $customClass = 'Concrete\\Package\\' .
            $app->make('helper/text')->camelcase($pkgHandle) .
            '\\Theme\\' . $themeName . '\\PageTheme';
    } else {
        $applicationClass = 'Application\\Theme\\' . $themeName . '\\PageTheme';
        $customClass = class_exists($applicationClass)
            ? $applicationClass
            : 'Concrete\\Theme\\' . $themeName . '\\PageTheme';
    }

    $theme = $app->make($customClass);
    $imageMap = $theme->getThemeResponsiveImageMap();

    $em = $app->make(\Doctrine\ORM\EntityManagerInterface::class);

    foreach ($imageMap as $handle => $width) {
        $type = $app->make(\Concrete\Core\File\Image\Thumbnail\Type\Type::class);
        $type = $type->getByHandle($handle);
        $width = (int) str_replace('px', '', $width);

        if ($type == null && $width > 0) {
            $type = new \Concrete\Core\Entity\File\Image\Thumbnail\Type\Type();
            $type->setHandle($handle);
            $type->setName(strtoupper($handle));
            $type->setWidth($width);
            $type->setHeight(null);
            $type->setSizingMode('proportional');
            $type->setIsUpscalingEnabled(false);
            $type->setKeepAnimations(true);
            $type->setSaveAreaBackgroundColor('');
            $type->setLimitedToFileSets(false);
            $em->persist($type);
            $em->flush($type);
        }
    }
});
