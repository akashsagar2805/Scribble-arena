# Scribble Arena

Scribble Arena is a realtime multiplayer drawing and guessing game built as a Laravel ecosystem portfolio project.

## Stack

- Laravel 13
- Laravel Boost
- Laravel Breeze
- Inertia.js
- Vue 3
- Tailwind CSS
- SQLite for local development
- PHPUnit

## Roadmap

- [x] Phase 1: Laravel, Vue/Inertia, Tailwind, and Boost setup
- [x] Phase 2: App shell, dashboard, and create/join room UI
- [ ] Phase 3: Game room models, room codes, and lobby flow
- [ ] Phase 4: Realtime player presence with Laravel Reverb
- [ ] Phase 5: Drawing canvas with Konva.js
- [ ] Phase 6: Guessing, scoring, timers, and round logic
- [ ] Phase 7: Match history, leaderboard, and portfolio polish

## Local Development

Install dependencies and build assets:

```bash
composer install
npm install
npm run build
php artisan migrate
```

Run the development stack:

```bash
composer run dev
```

Run tests:

```bash
php artisan test --compact
```
