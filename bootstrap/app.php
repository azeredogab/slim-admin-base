<?php 

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    
    $view = new \Slim\Views\Twig(__DIR__ . '/../app/views', [
        //'cache' => __DIR__ . '/../storage/cache'
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

include __DIR__ . '/../routes/web.php'; 

$app->run(); 

