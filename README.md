# Exodus 40 Lite

A Progressive Web App for a small men's group at St. Agatha St. James parish (West Philadelphia) to track their Lenten rule of life. The rule is adapted from [Exodus 90](https://exodus90.com), condensed to the 47 days of Lent 2026 (Ash Wednesday through Holy Saturday).

## Features

- **Daily checklist** across six categories: Prayer, Fasting, Almsgiving & Works of Charity, Fraternity, Stewardship, and Asceticism
- **Progress tracking** with a visual progress bar and day counter
- **Daily notes** with auto-save
- **Date navigation** through the Lent period with a "Go to Today" shortcut
- **Weekly item tracking** (e.g., 2/3 exercise sessions completed this week)
- **Offline support** via Service Worker with cache-first strategy
- **Optional user accounts** for syncing data across multiple devices
- **Installable** as a standalone app on mobile (PWA) or via the Android TWA wrapper

## Tech Stack

- **Frontend:** Vanilla HTML, CSS, and JavaScript (no frameworks, no build step)
- **Backend:** PHP + MySQL
- **Auth:** Token-based (64-character hex Bearer tokens)
- **Hosting:** Apache with HTTPS

## Project Structure

```
/                        Root (single-page app)
├── index.html           App entry point
├── app.js               Application logic
├── style.css            Styling (CSS custom properties, mobile-first)
├── sw.js                Service Worker
├── manifest.json        PWA manifest
├── .htaccess            Apache rewrites & SW cache control
├── api/                 PHP API endpoints
│   ├── config.php       DB connection, CORS, auth helpers
│   ├── login.php        Authentication
│   ├── register.php     Account creation
│   ├── data.php         Checklist data sync (GET/POST)
│   ├── logout.php       Token invalidation
│   └── private/         Credentials & schema (not served by HTTP)
├── android-twa/         Android Trusted Web Activity wrapper
├── documents/           Planning docs & specs
├── favicon_io/          Icons and favicons
└── .well-known/         Digital Asset Links for Android app verification
```

## Data Sync

Checklist data is stored in `localStorage` for offline use. Users who create an account get automatic server sync with timestamp-based conflict resolution (most recent change wins).

## Setup

1. Serve the project root with Apache (HTTPS recommended).
2. Copy `api/private/secrets.example.php` to `api/private/secrets.php` and fill in your MySQL credentials.
3. Run the SQL scripts in `api/private/` to create the database tables.
4. Visit the app in a browser and optionally install it to your home screen.
