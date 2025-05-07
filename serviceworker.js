const cacheVersion = 'damayRaya';

const filesToCache = [
  
  '/',
  '/index.html',
  '/new_db/index.html',
  '/new_db/manifest.json',
  '/new_db/logo/logo.png',
  '/assets/style.css',
  '/assets/responsive.css',
  '/assets/style.min.css'

];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheVersion)
      .then(function(cache) {
        return cache.addAll(filesToCache)
      })
  )
});

self.addEventListener("activate", event => {
  console.log("Service worker activated");
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(res) {
        if (res) return res;

        return fetch(event.request);
      })
  );
});