# Add To Home Screen

Add to home screen (A2HS)
The Easy way to add 'install app' for your websites.

```
Laravel 6+
```

## Commands
```bash
php artisan a2h:install
```

### Usage
- run `php artisan a2h:install` to copy the files over to your project
- include the javascript file and initialise like `new A2HClass();` in your main `app.js`
- Add the below in your master layout file
```
<meta name="theme-color" content="#fff"/>

<link rel="manifest" href="/manifest.json">

@if(config('app.env') === 'production')
	@include('a2h::a2h')
@endif
```

### Customise
- update manifest.json
- update the favicons with your logo
- update the js file where needed (e.g. to send an ajax to server)
- include your own view file (for html and styles)
- update ah2.blade to change default button text

### Output
 - Install command will copy the favicons to `/public/images/favicons`

## My Other Packages

- [Generators](https://github.com/bpocallaghan/generators) Easily File Generators with a config file and publishable stubs.
- [Notify](https://github.com/bpocallaghan/notify) Laravel Flash Notifications with icons and animations and with a timeout
- [Alert](https://github.com/bpocallaghan/alert) A helper package to flash a bootstrap alert to the browser via a Facade or a helper function.
- [Sluggable](https://github.com/bpocallaghan/sluggable) Provides a HasSlug trait that will generate a unique slug when saving your Laravel Eloquent model.
