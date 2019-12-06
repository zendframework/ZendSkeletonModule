# Zend Framework Skeleton Module

> ## Repository abandoned 2019-12-05
>
> This repository is no longer maintained.

This is a sample skeleton module for use with
[zend-mvc](https://docs.zendframework.com/zend-mvc) applications.

## Installation

First, decide on a namespace for your new module. For purposes of this README,
we will use `MyNewModule`.

Clone this repository into your application:

```bash
$ cd module
$ git clone https://github.com/zendframework/ZendSkeletonModule MyNewModule
$ cd MyNewModule
```

If you wish to version the new module with your application, and not as a
separate project, remove the various Git artifacts within it:

```bash
$ rm -Rf .git .gitignore
```

If you want to version it separately, remove the origin remote so you can
specify a new one later:

```bash
$ git remote remove origin
```

The next step will be to change the namespace in the various files. Open each
of `config/module.config.php`, `src/Module.php`, and
`src/Controller/SkeletonController.php`, and replace any occurence of
`ZendSkeletonModule` with your new namespace.

> ### find and sed
>
> You can also do this  with the Unix utilties `find` and `sed`:
>
> ```bash
> $ for php in $(find . -name '*.php');do
> > sed --in-place -e 's/ZendSkeletonModule/MyNewModule/g' $php
> > done
> ```

Next, we need to setup autoloading in your application. Open the `composer.json`
file in your application root, and add an entry under the `autoload.psr-4` key:

```json
"autoload": {
    "psr-4": {
        "MyNewModule\\": "module/MyNewModule/src/"
    }
}
```

When done adding the entry:

```bash
$ composer dump-autoload
```

Finally, notify your application of the module. Open
`config/modules.config.php`, and add it to the bottom of the list:

```php
return [
    /* ... */
    'MyNewModule',
]
```

> ### application.config.php
>
> If you are using an older version of the skeleton application, you may not
> have a `modules.config.php` file. If that is the case, open `config/application.config.php`
> instead, and add your module under the `modules` key:
>
> ```php
> 'modules' => [
>     /* ... */
>     'MyNewModule',
> ],
> ```