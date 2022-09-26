"use strict";

const CACHE_STATIC_NAME = 'static-v1';
const CACHE_DYNAMIC_NAME = 'dynamic-v1';

var CACHE_URLS = [
  '/',
  '/node/80',
];

var EXCLUDE_URLS = [
  '/node/86',
  '/node/95',
  '/admin'
];

self.addEventListener('install', function (event) {

  console.log('[Service Worker] Installing Service Worker...', event);
  /** Precache URLS v1 */
  if (CACHE_URLS.length) {
    event.waitUntil(caches.open(CACHE_STATIC_NAME)
      .then(function (cache) {
        return Promise.all(CACHE_URLS.concat(CACHE_URLS).map(function (url) {
          return fetch(url, { credentials: 'same-origin', mode: 'no-cors' })
            .then(function (response) {
              return cache.put(url, response);
            })
            .catch(function (error) {
              logError(error);
            });
        }));
      })
    );
  }
  /** Precache URLS v2 - simple */
  /*
  event.waitUntil(
    caches.open(CACHE_STATIC_NAME)
    .then(function (cache) {
      cache.addAll([
        '/',
        '/node/80',
        '/modules/custom/custom_pwa/js/serviceworker.js',
        '/modules/custom/custom_pwa/js/serviceworker-load.js',
      ]);
    })
  )
  */
});

self.addEventListener('activate', function (event) {
  console.log('[Service Worker] Activating Service Worker...', event);
  // return self.clients.claim();
});

self.addEventListener('fetch', function (event) {
  //console.log('[Service Worker] Fetching something...', event);

  if (event.request.method !== 'GET') {
    console.log('WORKER: fetch event ignored.', event.request.method, event.request.url);
    return;
  }

  for (let i = 0; i < EXCLUDE_URLS.length; i++) {
    if (event.request.url.indexOf(EXCLUDE_URLS[i]) !== -1) {
      console.log('WORKER: fetch event ignored. URL in exclude list.', event.request.url);
      return false;
    }
  }

  event.respondWith(
    caches.match(event.request)
      .then(function (response) {
        if (response) {
          return response;
        } else {
          return fetch(event.request)
            .then(function (res) {
              return caches.open(CACHE_DYNAMIC_NAME)
                .then(function (cache) {
                  cache.put(event.request.url, res.clone());
                  return res;
                });
            })
            .catch(function (err) {
            });
        }
      })
  );

});

/*
https://stackoverflow.com/questions/62598328/pwa-empty-service-worker-precache-runtime
https://stackoverflow.com/questions/66330440/how-to-check-for-installed-web-app-pwa-updates-when-using-precache-method
https://web.dev/add-manifest/
https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API
https://stackoverflow.com/questions/46541071/progressive-web-app-does-not-work-offline-error
https://github.com/shadowwalker/next-pwa/issues/313
https://pwa-workshop.js.org/3-precaching/#put-files-in-cache-automatically
https://web.dev/learn/pwa/tools-and-debug/
https://developer.mozilla.org/en-US/docs/Web/API/Cache
https://www.harrytheo.com/blog/2021/03/cache-handling-with-service-workers-and-the-cache-api/
https://gist.github.com/JMPerez/8ca8d5ffcc0cc45a8b4e1c279efd8a94
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/includes
https://blog.bitsrc.io/5-service-worker-caching-strategies-for-your-next-pwa-app-58539f156f52
https://syndicode.com/blog/caching-strategies-for-pwa/
https://css-tricks.com/add-a-service-worker-to-your-site/
https://pwa-workshop.js.org/3-precaching/#testing-offline
*/
