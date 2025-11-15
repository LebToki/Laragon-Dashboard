/**
 * Laragon Dashboard Service Worker
 * Enables offline functionality and caching for PWA
 */

const CACHE_NAME = 'laragon-dashboard-v1.1';
const RUNTIME_CACHE = 'laragon-dashboard-runtime-v1.1';

// Get base path from scope
const BASE_PATH = self.location.pathname.replace('/sw.js', '');

// Assets to cache on install (relative to base path)
const PRECACHE_ASSETS = [
    BASE_PATH + '/',
    BASE_PATH + '/index.php',
    BASE_PATH + '/assets/css/style.css',
    BASE_PATH + '/assets/css/lib/bootstrap.min.css',
    BASE_PATH + '/assets/css/lib/monochrome-mode.css'
];

// Install event - cache assets (with error handling)
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                // Cache assets individually to handle failures gracefully
                return Promise.allSettled(
                    PRECACHE_ASSETS.map(url => {
                        return fetch(url)
                            .then(response => {
                                if (response.ok) {
                                    return cache.put(url, response);
                                }
                                throw new Error(`Failed to fetch ${url}: ${response.status}`);
                            })
                            .catch(error => {
                                console.warn(`Failed to cache ${url}:`, error);
                                // Don't fail the entire install if one asset fails
                                return Promise.resolve();
                            });
                    })
                );
            })
            .then(() => self.skipWaiting())
            .catch(error => {
                console.error('Service Worker install failed:', error);
                // Still skip waiting even if caching fails
                self.skipWaiting();
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((cacheName) => {
                        return cacheName !== CACHE_NAME && cacheName !== RUNTIME_CACHE;
                    })
                    .map((cacheName) => {
                        return caches.delete(cacheName);
                    })
            );
        })
            .then(() => self.clients.claim())
    );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
    // Skip non-GET requests
    if (event.request.method !== 'GET') {
        return;
    }

    // Skip cross-origin requests
    if (!event.request.url.startsWith(self.location.origin)) {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then((cachedResponse) => {
                if (cachedResponse) {
                    return cachedResponse;
                }

                return fetch(event.request)
                    .then((response) => {
                        // Don't cache if not a valid response
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Clone the response
                        const responseToCache = response.clone();

                        // Cache the response
                        caches.open(RUNTIME_CACHE)
                            .then((cache) => {
                                cache.put(event.request, responseToCache);
                            });

                        return response;
                    })
                    .catch(() => {
                        // Return offline page if available
                        if (event.request.destination === 'document') {
                            return caches.match(BASE_PATH + '/index.php') || caches.match(BASE_PATH + '/');
                        }
                    });
            })
    );
});

