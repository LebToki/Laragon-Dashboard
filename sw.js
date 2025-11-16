/**
 * Laragon Dashboard Service Worker
 * Enables offline functionality and caching for PWA
 */

const CACHE_NAME = 'laragon-dashboard-v1.2';
const RUNTIME_CACHE = 'laragon-dashboard-runtime-v1.2';

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

    // Skip requests that look like they're redirecting to login
    const url = new URL(event.request.url);
    if (url.pathname.includes('/login') || url.searchParams.has('redirect')) {
        // Don't cache login redirects, just fetch normally
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then((cachedResponse) => {
                // Only use cache if it's a valid response (not 404, not redirect)
                if (cachedResponse && cachedResponse.status === 200 && cachedResponse.type === 'basic') {
                    return cachedResponse;
                }

                // If cached response is bad, delete it
                if (cachedResponse) {
                    caches.open(RUNTIME_CACHE).then((cache) => {
                        cache.delete(event.request);
                    });
                }

                return fetch(event.request)
                    .then((response) => {
                        // Don't cache if not a valid response (404, redirects, errors)
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Don't cache if response is a redirect
                        if (response.redirected || response.url.includes('/login')) {
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
                        // For assets, return the failed response (don't cache 404s)
                        return new Response('', { status: 404, statusText: 'Not Found' });
                    });
            })
    );
});

