# Install
composer update

# Generate New Key
php artisan key:generate

# Migration and DB seeder (after changing your DB settings in .env)
php artisan migrate --seed

# Install dependency with NPM 14
npm install

# develop
npm run dev # or npm run watch

# Build on production
npm run production
```
