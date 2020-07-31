/*self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open('app-name').then(function(cache) {
            return cache.addAll([
                '/path/to/html,css,js,images',
            ]);
        })
    );
});*/

self.addEventListener('fetch', function(e) {
    e.respondWith(
        caches.match(e.request).then(function(response) {
            return response || fetch(e.request);
        })
    );
});
