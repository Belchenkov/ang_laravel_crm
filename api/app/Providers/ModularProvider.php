<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class ModularProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config('modular.modules');
        $path = config('modular.path');

        if ($modules) {
            Route::group([
                'prefix' => ''
            ], function () use ($modules, $path) {
                foreach ($modules as $module => $sub_modules) {
                    foreach ($sub_modules as $key => $sub) {
                        $relative_path = '/' . $module . '/' . $sub;


                        Route::middleware('web')
                            ->group(function () use ($module, $sub, $relative_path, $path) {
                                $this->getWebRoutes($module, $sub, $relative_path, $path);
                            });

                        Route::prefix('api')
                            ->middleware('api')
                            ->group(function () use ($module, $sub, $relative_path, $path) {
                                Passport::routes();
                                $this->getApiRoutes($module, $sub, $relative_path, $path);
                            });
                    }
                }
            });
        }

        $this->app['view']->addNamespace('Pub', base_path() . '/resources/views/Pub');
        $this->app['view']->addNamespace('Admin', base_path() . '/resources/views/Admin');
    }

    private function getWebRoutes($module, $sub, $relative_path, $path)
    {
        $routes_path = $path . $relative_path . '/Routes/web.php';

        if (file_exists($routes_path)) {
            if ($module != config('modular.groupWithoutPrefix')) {
                Route::group(
                    [
                        'prefix' => strtolower($module),
                        'middleware' => $this->getMiddleware($module)
                    ],
                    function () use ($module, $sub, $routes_path) {
                        Route::namespace("App\Modules\\$module\\$sub\Controllers")->group($routes_path);
                    }
                );
            } else {
                Route::namespace("App\Modules\\$module\\$sub\Controllers")
                    ->middleware($this->getMiddleware($module))
                    ->group($routes_path);
            }
        }
    }

    private function getApiRoutes($module, $sub, $relative_path, $path)
    {
        $routes_path = $path . $relative_path . '/Routes/api.php';

        if (file_exists($routes_path)) {
            Route::group(
                [
                    'prefix' => strtolower($module),
                    'middleware' => $this->getMiddleware($module, 'api')
                ],
                function () use ($module, $sub, $routes_path) {
                    Route::namespace("App\Modules\\$module\\$sub\Controllers")->group($routes_path);
                }
            );
        }
    }

    private function getMiddleware($module, string $key = 'web'): array
    {
        $middleware = [];
        $config = config('modular.groupMiddleware');

        if (isset($config[$module])) {
            if (array_key_exists($key, $config[$module])) {
                $middleware = array_merge($middleware, $config[$module][$key]);
            }
        }

        return $middleware;
    }
}
