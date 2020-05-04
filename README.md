# Product catalog

Product catalog administration as well as API,customer login and products.

## Server requirements



- PHP >= **7.4**
- `BCMath` PHP Extension
- `Ctype` PHP Extension
- `Fileinfo` PHP extension
- `JSON` PHP Extension
- `Mbstring` PHP Extension
- `OpenSS`L PHP Extension
- `PDO` PHP Extension
- `Tokenizer` PHP Extension
- `XML` PHP Extension
- `Redis` PHP Extention

## Install

- Run `composer install` command.
- Create `Database` with `credentials`,
- Run `copy .env.example .env` command and  `update database` credentials with your data base info,
- Run `php artisan key:generate` command,
- Change `APP_URL` on `.env` file by your own,
- Add `FILESYSTEM_DRIVER=public` to `.env` file,
- Run `php artisan storage:link` command,
- Run `php artisan migrate` command,
- Run `php artisan db:seed --class=InitalDataSeeder` command,
- Create first admin user run `php artisan admin:create` command,
- Run `php artisan passport:install` command,
- To `config\app.php` file `aliases` array add 'PriceFormatter'=>\Modules\Product\Facades\PriceFormatter::class
- If you don't have virtualization run `php artisan serve` command
- Go to your domain on web browser
