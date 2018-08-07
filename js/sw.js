var offlineFundamentals = [
'/',
'/offline',
'/css/all.css',
'/js/all.js'
];
self.addEventListener('install', function installer (event) {
  event.waitUntil(
    caches
    .open('v1::fundamentals')
    .then(function prefill (cache) {
      cache.addAll(offlineFundamentals);
    })
    );
});