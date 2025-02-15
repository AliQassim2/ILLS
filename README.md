To start your project, you need to install Laravel. If you haven't downloaded it yet, run the following commands in your terminal:

composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev # (For frontend assets)

Then, run the following commands to start the server:

php artisan migrate
php artisan serve
Once the server is running, check the URL provided in the terminal. The default is usually:
http://127.0.0.1:8000
