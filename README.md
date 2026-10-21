# Composer Based Skeleton for LGT Concrete sites

This is a customised version for use by Limegreentangerine for quick project setup. Forked from [`concretecms/composer`][concrete-composer-link].

## Creating a new project

First choose a name for your project. In this example, our project is called "new_site"

```bash
$ composer create-project -n limegreentangerine/lgt-concrete new_site
```

Now you have the latest version of Concrete and you're ready to install!

Note: This is a skeleton project. So once you create a project, you can install your own VCS and change the README and all that.

## Known Issue with patcher hanging on `concretecms/dependency-patches`

There is an issue on Mac when composer runs concrete dependency patches.

If the `concretecms/dependency-patches` hangs on install, run the following:

```bash
$ brew install gpatch
$ brew link gpatch --force --overwrite
$ composer install
```

If you've already done this before and it still hangs, the issue can also be solved by agreeing to the `xcodebuild` terms and conditions, run:

```bash
$ sudo xcodebuild -license
$ composer install
```

## Installing Concrete

Navigate into your new Concrete project

```bash
$ cd new_site
```

and use the interactive install commmand that comes with Concrete's CLI tool

```bash
$ ./vendor/bin/concrete c5:install -i
```
Follow directions and your site will begin installing!


Note: You can also run the CLI tool directly with PHP

```bash
$ ./public/concrete/bin/concrete
```

## Preinstalled LGT Packages

Comes with three packages installed as standard, [limegreentangerine/class_kit][classkit-link], [limegreentangerine/lgt_toolkit][toolkit-link] and [limegreentangerine/theme_kit][themekit-link].

Other LGT packages are available from the [LGT Packagist][lgt-packagist-link] or our [private package repository](#packageslimegreentangerinenet).

## Install a Concrete package using composer

Find the package you'd like to install on [packagist.org](https://packagist.org) (in this case [`concretecms/sample_composer_package`](https://packagist.org/packages/concretecms/sample_composer_package))

Note: You can also use composer's repository functionality to manage private packages using composer

```bash
$ composer require concretecms/sample_composer_package
$ ./vendor/bin/concrete c5:package-install sample_composer_package
```

***PLEASE NOTE:* If you are installing packages through composer you may want to add their folder to packages folders [`.gitignore`][link-packages-gitignore] to keep repo size down, these will get installed on deployment anyway.**

## packages.limegreentangerine.net

Private pacakges can be found at the LGT [private composer package website][lgt-satis-link] *(a limegreentangerine email address is required for web access)*. These can be installed in the normal way after some authentication headers are added to your global composer configuration.

To authenticate with the private registry, configure Composer to send the Cloudflare Access service token headers for `packages.limegreentangerine.net`, you should only have to do this setup once to make it available for all future projects.

After obtaining the correct ID and Secret, run the following in terminal:

```bash
composer config --global custom-headers.packages.limegreentangerine.net \
  "CF-Access-Client-Id: YOUR_CLIENT_ID" \
  "CF-Access-Client-Secret: YOUR_CLIENT_SECRET"
```


## Compiling JS / CSS assets
This library uses [Laravel Mix][link-mix]. See [webpack.mix.js][link-webpack-mix-file].
To build assets:

```bash
npm install
npm run dev   # Build for development
npm run hot   # Build with hot reloading enabled (See hot reloading section)
npm run watch # Build with a watcher that rebuilds when files change
npm run prod  # Build for production
```

### Hot Module Replacement
Hot module replacement (hot reloading) allows you to write code and instantly see the changes in your browser, without reloading the page.
In order to use hot reloading with Concrete, you'll want to use the `mix` and `mixAsset` helper functions to wrap your
js and css urls. These functions make it so that your assets automatically detect hot reloading mode and output the
appropriate urls, they are safe to use in production:

In a page theme:
```php
<?php
use function Concrete5\Composer\mixAsset;
...

class PageTheme extends Theme
{
  public function registerAssets()
  {
    $this->requireAsset(mixAsset('/path/to/file.js'));
  }
}
```

```php
<?php
use function Concrete5\Composer\mixAsset;
...

class Controller extends BlockController
{
    public function registerViewAssets()
    {
        $this->requireAsset(mixAsset('/path/to/js/file.js'));
        $this->requireAsset(mixAsset('/path/to/css/file.css'));
    }
}
```
or in a theme template:
```php
<?php
use function Concrete5\Composer\mix;
?>

<script src='<?= mix('/path/to/your/asset.js') ?>'></script>
<link href='<?= mix('/path/to/your/asset.css') ?>' />
```

## Testing

Testing can be run using:

```bash
$ composer test
```

## Code Formatting

### Typechecking

You can check PHP types are correct by running:

```bash
$ composer typecheck
```

### Formatting

Formatting for PHP and TS/JS is included, to check run:

```bash
$ composer format:check
```
To format run:

```bash
$ composer format
```

[link-mix]: https://laravel.com/docs/5.5/mix
[link-webpack-mix-file]: ./webpack.mix.js
[link-packages-gitignore]: ./public/packages/.gitignore
[concrete-composer-link]: https://github.com/concretecms/composer
[classkit-link]: https://packagist.org/packages/limegreentangerine/class_kit
[toolkit-link]: https://packagist.org/packages/limegreentangerine/lgt_toolkit
[themekit-link]: https://packagist.org/packages/limegreentangerine/lgt_toolkit
[lgt-packagist-link]: https://packagist.org/packages/limegreentangerine
[lgt-satis-link]: https://packages.limegreentangerine.net
