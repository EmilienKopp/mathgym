<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Math Gym
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <header>
         <?= $this->element('navbar'); ?>
        <div class="container text-center">
            <h1>
                算数の「道場」へようこそ
            </h1>
            <?= $this->Html->image('sansuu.jpg', ['alt' => '算数', 'width' => 350]);?>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        
                    </div>
                    <div class="column">
                        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column">
                       
                    </div>
                    <div class="column">
                       
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Getting Started</h3>
                        <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/en/">CakePHP Documentation</a>
                        <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/en/tutorials-and-examples/cms/installation.html">The 20 min CMS Tutorial</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Help and Bug Reports</h3>
                        <a target="_blank" rel="noopener" href="irc://irc.freenode.net/cakephp">irc.freenode.net #cakephp</a>
                        <a target="_blank" rel="noopener" href="http://cakesf.herokuapp.com/">Slack</a>
                        <a target="_blank" rel="noopener" href="https://github.com/cakephp/cakephp/issues">CakePHP Issues</a>
                        <a target="_blank" rel="noopener" href="http://discourse.cakephp.org/">CakePHP Forum</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Docs and Downloads</h3>
                        <a target="_blank" rel="noopener" href="https://api.cakephp.org/">CakePHP API</a>
                        <a target="_blank" rel="noopener" href="https://bakery.cakephp.org">The Bakery</a>
                        <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/en/">CakePHP Documentation</a>
                        <a target="_blank" rel="noopener" href="https://plugins.cakephp.org">CakePHP plugins repo</a>
                        <a target="_blank" rel="noopener" href="https://github.com/cakephp/">CakePHP Code</a>
                        <a target="_blank" rel="noopener" href="https://github.com/FriendsOfCake/awesome-cakephp">CakePHP Awesome List</a>
                        <a target="_blank" rel="noopener" href="https://www.cakephp.org">CakePHP</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column links">
                        <h3>Training and Certification</h3>
                        <a target="_blank" rel="noopener" href="https://cakefoundation.org/">Cake Software Foundation</a>
                        <a target="_blank" rel="noopener" href="https://training.cakephp.org/">CakePHP Training</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
