<?php

namespace Deployer;

require 'recipe/laravel.php';

set('application', 'portfolio');
set('repository', 'https://github.com/dlindeboom/portfolio.git');
set('writable_mode', 'chown');

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'npm:install',
    'npm:production',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
    'artisan:storage:link',
    'artisan:migrate',
    'deploy:publish',
]);

task('npm:install', function () {
    run('cd {{release_path}} && npm install');
});

task('npm:production', function () {
    run('cd {{release_path}} && npm run build');
});

host('production')
    ->set('hostname', getenv('DEPLOY_HOST'))
    ->set('remote_user', getenv('DEPLOY_USER'))
    ->set('port', getenv('DEPLOY_PORT'))
    ->set('deploy_path', getenv('DEPLOY_PATH'));

after('deploy:failed', 'deploy:unlock');
