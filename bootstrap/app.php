    <?php

    use Illuminate\Foundation\Application;
    use Illuminate\Foundation\Configuration\Exceptions;
    use Illuminate\Foundation\Configuration\Middleware;

    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware) {
            // Register your custom 'admin' middleware alias here
            $middleware->alias([
                'admin' => \App\Http\Middleware\AdminMiddleware::class,
            ]);

            // You might also want to add it to the 'web' middleware group if it applies to all web routes
            // $middleware->web(append: [
            //     \App\Http\Middleware\AdminMiddleware::class, // If you want it on ALL web routes
            // ]);

            // If you have other middleware groups or aliases, they would go here
        })
        ->withExceptions(function (Exceptions $exceptions) {
            //
        })->create();
