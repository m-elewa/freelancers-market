@servers(['localhost' => '127.0.0.1'])

@task('deploy', ['on' => 'localhost'])
    git pull origin master
    composer install
    php artisan migrate:fresh --seed
    npm install
    npm run dev
@endtask