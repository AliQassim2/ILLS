To start your project, you need to install Laravel. If you haven't downloaded it yet, run the following commands in your terminal:
<br>
composer require laravel/breeze --dev <br>
php artisan breeze:install <br>
php artisan migrate<br>
npm install && npm run dev # (For frontend assets)<br>

Then, run the following commands to start the server:
<br>
php artisan migrate<br>
php artisan serve<br>
Once the server is running, check the URL provided in the terminal. The default is usually:
http://127.0.0.1:8000
