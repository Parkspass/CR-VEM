/*jshint esversion: 6 */
const cacheName = 'v1::static';

self.addEventListener('install', function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll([
        './images/bison.svg',
        './images/minus_btn.svg',
        './images/plus_btn.svg',
        './images/android-chrome-192x192.png',
        './images/android-chrome-512x512.png',
        './images/apple-touch-icon.png',
        './browserconfig.xml',
        './images/favicon-16x16.png',
        './images/favicon-32x32.png',
        './favicon.ico',
        './images/mstile-150x150.png',
        './images/safari-pinned-tab.svg',
        './site.webmanifest',
        './sw.js',
        './addLocation.php',
        './addPark.php',
        './adjust_location_count.php',
        './getLocationList.php',
        './getParkList.php',
        './gotoPark.php',
        './index.html',
        './zion/adjust_location_count.php',
        './zion/index.html',
      ]).then(() => self.skipWaiting());
    })
  );
});

// when the browser fetches a url, either response with
// the cached object or go ahead and fetch the actual url
self.addEventListener('fetch', function(e) {
  e.respondWith(
    // ensure we check the *right* cache to match against
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});

// var cacheName = 'hello-pwa';
// var filesToCache = [
//   '/',
//   '/index.html',
//   '/css/style.css',
//   '/js/main.js'
// ];



// /* Serve cached content when offline */
// self.addEventListener('fetch', function(e) {
//   e.respondWith(
//     caches.match(e.request).then(function(response) {
//       return response || fetch(e.request);