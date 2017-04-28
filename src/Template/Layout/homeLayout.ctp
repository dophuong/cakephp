<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$Description = "PhuongDo' Blog";
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>
        <?= $Description ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('home.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('mycss.css') ?>
    <?= $this->Html->css('comment.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<body>
<div class="page">
    <div class="row">
        <?= $this->Flash->render() ?>
        <div class="home">
            <?= $this->fetch('content') ?>

            <div class="col-sm-1"></div>
            <div class="column large-3">
                <h4>List of users</h4>
                <?php
                foreach ($users as $user):
                    $userId = $user->id; ?>
                    <h5><span
                            class="glyphicon glyphicon-user"></span><?= $this->Html->link(" " . $user->username, ['controller' => 'Posts', 'action' => 'upost', $userId]) ?>
                    </h5>
                <?php endforeach; ?>
                <div class="p-content p-display-container" style="max-width: 400px ; max-height: 200px; margin: 0px">

                    <div class="w3-display-container mySlides">
                        <img class="animate-top" src="/img/thac.jpg" style="width:100%">
                        <div class="p-container p-display-topright p-black">
                            <a href="https://www.nhk.or.jp/lesson/vietnamese/syllabary/">Học tiếng Nhật</a>
                        </div>
                    </div>
                    <div class="w3-display-container  mySlides">
                        <img class="animate-bottom" src="/img/hoa.jpg" style="width:100%">
                        <div class="p-container p-display-topright p-black">
                            <a href="http://www.esl-lab.com/">Học tiếng Anh</a>
                        </div>
                    </div>
                    <div class="w3-display-container  mySlides">
                        <img class="animate-top" src="/img/uploadbg2.jpg" style="width:100%">
                        <div class="p-container p-display-topright p-black">
                            <a href="http://unckel.de/kanateacher/index-en.html">Học tiếng Nhật</a>
                        </div>
                    </div>
                    <?= $this->Html->script('slideImage.js') ?>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row" style="height: auto">
        <div class="columns large-12">
            <h3><?= $this->Html->link(_('Add post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </h3>
        </div>
    </div>
    <hr/>
    <footer>
        <div class="row">
            <div class="columns large-12 text-center">
                <h3 class="more">More about </h3>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
