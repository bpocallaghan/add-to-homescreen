# Add To Home Screen

Add to home screen (A2HS): Easy way to add 'install app' for your websites.

```
Laravel 6+    
```

## Commands
```bash
php artisan a2h:install
```

### Usage
- run `php artisan a2h:install` to copy the files over to your project
- Add the below in your master layout file
```
<meta name="theme-color" content="#ffffff"/>

<link rel="manifest" href="/manifest.json">
```

### Output
 - Install command will copy the favicons to `/public/images/favicons`

## My other Packages

- [Generators](https://github.com/bpocallaghan/generators) Easily File Generators with a config file and publishable stubs. 
- [Notify](https://github.com/bpocallaghan/notify) Laravel Flash Notifications with icons and animations and with a timeout
- [Alert](https://github.com/bpocallaghan/alert) A helper package to flash a bootstrap alert to the browser via a Facade or a helper function.
- [Sluggable](https://github.com/bpocallaghan/sluggable) Provides a HasSlug trait that will generate a unique slug when saving your Laravel Eloquent model.
