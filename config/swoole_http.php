<?php
return [
    /*
    |--------------------------------------------------------------------------
    | HTTP server configurations.
    |--------------------------------------------------------------------------
    |
    | @see https://www.swoole.co.uk/docs/modules/swoole-server/configuration
    |
    */
    'server' => [
        'host' => env('SWOOLE_HTTP_HOST', '0.0.0.0'),
        'port' => env('SWOOLE_HTTP_PORT', '1215'),
        'public_path' => base_path('public'),
        // Determine if to use swoole to respond request for static files
        'handle_static_files' => env('SWOOLE_HANDLE_STATIC', true),
        'access_log' => env('SWOOLE_HTTP_ACCESS_LOG', false),
        // You must add --enable-openssl while compiling Swoole
        // Put SWOOLE_SOCK_TCP | SWOOLE_SSL if you want to enable SSL
        'socket_type' => SWOOLE_SOCK_TCP,
        'process_type' => SWOOLE_PROCESS,
        'options' => [
            'pid_file' => env('SWOOLE_HTTP_PID_FILE', base_path('storage/logs/swoole_http.pid')),
            'log_file' => env('SWOOLE_HTTP_LOG_FILE', base_path('storage/logs/swoole_http.log')),
            'daemonize' => env('SWOOLE_HTTP_DAEMONIZE', false),
            // Normally this value should be 1~4 times larger according to your cpu cores.
            'reactor_num' => env('SWOOLE_HTTP_REACTOR_NUM', 1),
            'worker_num' => env('SWOOLE_HTTP_WORKER_NUM', swoole_cpu_num()),
            'task_worker_num' => env('SWOOLE_HTTP_TASK_WORKER_NUM', 1),
            // The data to receive can't be larger than buffer_output_size.
            'package_max_length' => 200 * 1024 * 1024,
            // The data to send can't be larger than buffer_output_size.
            'buffer_output_size' => 100 * 1024 * 1024,
            // Max buffer size for socket connections
            'socket_buffer_size' => 128 * 1024 * 1024,
            // Worker will restart after processing this number of requests
            // 'max_request' => env("SWOOLE_MAX_REQUEST", 1),
            // Enable coroutine send
            'send_yield' => true,
            // You must add --enable-openssl while compiling Swoole
            'ssl_cert_file' => null,
            'ssl_key_file' => null,
            'max_connection' => env('SWOOLE_HTTP_MAX_CONNECTION', 65536), // 服务器程序，最大允许的连接数, 此参数用来设置Server最大允许维持多少个TCP连接。超过此数量后，新进入的连接将被拒绝
            'max_request' => env('SWOOLE_HTTP_MAX_REQUEST', 1024), // 设置worker进程的最大任务数，默认为0，一个worker进程在处理完超过此数值的任务后将自动退出，进程退出后会释放所有内存和资源。
            // 'backlog' => 1280, // Listen队列长度，如backlog => 128，此参数将决定最多同时有多少个等待accept的连接
            // 'tcp_fastopen' => true, // 开启TCP快速握手特性。此项特性，可以提升TCP短连接的响应速度，在客户端完成握手的第三步，发送SYN包时携带数据
        ],
    ],
/*
    |--------------------------------------------------------------------------
    | Enable to turn on websocket server.
    |--------------------------------------------------------------------------
    */
    'websocket' => [
        'enabled' => env('SWOOLE_HTTP_WEBSOCKET', false),
    ],
/*
    |--------------------------------------------------------------------------
    | Hot reload configuration
    |--------------------------------------------------------------------------
    */
    'hot_reload' => [
        'enabled' => env('SWOOLE_HOT_RELOAD_ENABLE', false),
        'recursively' => env('SWOOLE_HOT_RELOAD_RECURSIVELY', true),
        'directory' => env('SWOOLE_HOT_RELOAD_DIRECTORY', base_path()),
        'log' => env('SWOOLE_HOT_RELOAD_LOG', true),
        'filter' => env('SWOOLE_HOT_RELOAD_FILTER', '.php'),
    ],
/*
    |--------------------------------------------------------------------------
    | Console output will be transferred to response content if enabled.
    |--------------------------------------------------------------------------
    */
    'ob_output' => env('SWOOLE_OB_OUTPUT', true),
/*
    |--------------------------------------------------------------------------
    | Pre-resolved instances here will be resolved when sandbox created.
    |--------------------------------------------------------------------------
    */
    'pre_resolved' => [
        'view', 'files', 'session', 'session.store', 'routes',
        'db', 'db.factory', 'cache', 'cache.store', 'config', 'cookie',
        'encrypter', 'hash', 'router', 'translator', 'url', 'log',
    ],
/*
    |--------------------------------------------------------------------------
    | Instances here will be cleared on every request.
    |--------------------------------------------------------------------------
    */
    'instances' => [
        //
    ],
/*
    |--------------------------------------------------------------------------
    | Providers here will be registered on every request.
    |--------------------------------------------------------------------------
    */
    'providers' => [
        Illuminate\Pagination\PaginationServiceProvider::class,
    ],
/*
    |--------------------------------------------------------------------------
    | Resetters for sandbox app.
    |--------------------------------------------------------------------------
    */
    'resetters' => [
        SwooleTW\Http\Server\Resetters\ResetConfig::class,
        SwooleTW\Http\Server\Resetters\ResetSession::class,
        SwooleTW\Http\Server\Resetters\ResetCookie::class,
        SwooleTW\Http\Server\Resetters\ClearInstances::class,
        SwooleTW\Http\Server\Resetters\BindRequest::class,
        SwooleTW\Http\Server\Resetters\RebindKernelContainer::class,
        SwooleTW\Http\Server\Resetters\RebindRouterContainer::class,
        SwooleTW\Http\Server\Resetters\RebindViewContainer::class,
        SwooleTW\Http\Server\Resetters\ResetProviders::class,
    ],
/*
    |--------------------------------------------------------------------------
    | Define your swoole tables here.
    |
    | @see https://www.swoole.co.uk/docs/modules/swoole-table
    |--------------------------------------------------------------------------
    */
    'tables' => [
        // 'table_name' => [
        //     'size' => 1024,
        //     'columns' => [
        //         ['name' => 'column_name', 'type' => Table::TYPE_STRING, 'size' => 1024],
        //     ]
        // ],
    ],
]; 
