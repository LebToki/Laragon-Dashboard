<?php
/**
 * Platform identity — Laragon-Dashboard (Windows)
 *
 * This is the ONLY file that is allowed to differ between Laragon-Dashboard
 * and Nucleus. Shared core code reads identity from here and must never
 * hardcode a product name or a GitHub repository.
 *
 * Returned keys:
 *   product     — stable id used to validate update packages
 *   platform    — 'linux' | 'windows'
 *   update_repo — GitHub "owner/repo" the updater pulls releases from
 */

return [
    'product'     => 'laragon-dashboard',
    'platform'    => 'windows',
    'update_repo' => 'LebToki/Laragon-Dashboard',
];
