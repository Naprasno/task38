<?php 
//print_r ($pageData['subscriptions']);
?>
<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $pageData['title']; ?></title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin/metisMenu.min.css" rel="stylesheet">
    <link href="/css/admin/sb-admin-2.css" rel="stylesheet">
    <link href="/css/admin/morris.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Кабинет</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <?php 
                if ($_SESSION['user']['type_user'] == 1) {
					echo "Вы вошли как Веб-мастер <b>".$_SESSION['user']['login']  ;
                }
                if ($_SESSION['user']['type_user'] == 0){
                    echo "Вы вошли как Рекламодатель <b>".$_SESSION['user']['login']  ;
                }
                if ($_SESSION['user']['type_user'] == 10){
                    echo "Вы вошли как Администратор <b>".$_SESSION['user']['login']  ;
                }
                ?>
                    <a href="/cabinet/logout">Выйти</a>
                    
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="/cabinet"><i class="fa fa-area-chart"></i> Главная</a>
                        </li>
                        <?php 
                        if ($_SESSION['user']['type_user'] == 10) {
                        ?>
                            <li>
                                <a href="/user"><i class="fa fa-cart-plus"></i> Пользователи</a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Общая статистика</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php 
                                            if ($_SESSION['user']['type_user'] == 1) {
                                                echo $pageData['offersCount']; 
                                            }
                                            if ($_SESSION['user']['type_user'] == 0){
                                                echo $pageData['offersCountAd']; 
                                            }
                                            if ($_SESSION['user']['type_user'] == 10){
                                                echo $pageData['offersCountAdmin']; 
                                            }
                                        ?>
                                    </div>
                                    
                                    <div> <?php
                                        if ($_SESSION['user']['type_user'] == 10){
                                            echo '<div>ссылок</div>'; 
                                        ?>
                                        <?php
                                        } else{
                                            echo '<div>офферов</div>';
                                        }
                                        ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cart-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php 
                                        if ($_SESSION['user']['type_user'] == 1) {
                                            echo $pageData['offersClicks'];  
                                        }
                                        if ($_SESSION['user']['type_user'] == 0){
                                            echo $pageData['offersClicksAd']; 
                                        }
                                        if ($_SESSION['user']['type_user'] == 10){
                                            echo $pageData['offersClicksAdmin']; 
                                        }
                                        ?>
                                    </div>
                                    <div>кликов</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                       <?php 
                                        if ($_SESSION['user']['type_user'] == 1) {
                                            echo $pageData['offersSumm'] . ' р';   
                                        }
                                        if ($_SESSION['user']['type_user'] == 0){
                                            echo $pageData['offersSummAd'] . ' р'; 
                                        }
                                        if ($_SESSION['user']['type_user'] == 10){
                                            echo $pageData['offersRejectAdmin']; 
                                        }
                                       ?>
                                    </div>
                                        <?php
                                        if ($_SESSION['user']['type_user'] == 10){
                                                echo '<div>отказов</div>'; 
                                        ?>
                                        <?php
                                        } else{
                                            echo '<div>сумма</div>';
                                        }
                                        ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <?php 
                            if ($_SESSION['user']['type_user'] != 10) {
                        ?>
                    <div class="panel panel-default">
                         
                         
                        <div class="panel-heading">
                            Список оферов
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">

                                    <?php /*  --------ВЕБ МАСТЕР общая таблица-------------------*/
                                        if ($_SESSION['user']['type_user'] == 1) {
                                            
                                        ?>

                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Название</th>
                                                        <th>Цена перехода</th>
                                                        <th>URL</th>
                                                        <th>Подписка</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pageData['offers'] as $key => $value) {
                                                        echo "<tr>";
                                                            echo "<td>" . $value['name'] . "</td>";
                                                            echo "<td>" . $value['price'] . "</td>";
                                                            echo "<td>" . $value['url'] . "</td>";
                                                            echo "<td> <a href='cabinet/vendor?offer_id=" . $value['id'] . "'>подписаться</a></td>";
                                                        echo "<tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        }/*  --------РЕКЛАМОДАТЕЛЬ таблица-------------------*/
                                        if ($_SESSION['user']['type_user'] == 0){
                                        ?>
                                           <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Название</th>
                                                        <th>Цена перехода</th>
                                                        <th>Целевой URL</th>
                                                        <th>Кол-во подписок</th>
                                                        <th>Активность</th>
                                                        <th>Статистика</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pageData['offersAd'] as $key => $value) {
                                                        echo "<tr>";
                                                            echo "<td>" . $value['name'] . "</td>";
                                                            echo "<td>" . $value['price'] . "</td>";
                                                            echo "<td>" . $value['url'] . "</td>";
                                                            echo "<td>" . $value['counts'] . "</td>";
                                                            if ($value['enable'] ==1) {
                                                                echo "<td><a href='cabinet/vendor?offer_id_off=" . $value['id'] ."'>деактивировать</a></td>";
                                                            }else{
                                                                echo "<td>" .   "выкл" . "</td>";
                                                            }
                                                            echo "<td> <a href='cabinet/statistics?offer_id=" . $value['id'] . "'>подробнее</a></td>";

                                                        echo "<tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        <?php
                                        }
                                    ?>

                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?php   } ?>

                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->

                <!-- Подписки -->
                <div class="col-lg-12">


                    <?php /*  --------ВЕБ МАСТЕР таблица подписок-------------------*/
                        if ($_SESSION['user']['type_user'] == 1) {
                                            
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Список подписок
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Название</th>
                                                    <th>Цена перехода</th>
                                                    <th>целевой URL</th>
                                                    <th>Ваша ссылка</th>
                                                    <th>Кол-во переходов</th>
                                                    <th>Активность</th>
                                                    <th>Подписка</th>
                                                    <th>Статистика</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pageData['subscriptions'] as $key => $value) {
                                                	echo "<tr>";
                                                		echo "<td>" . $value['name'] . "</td>";
                                                		echo "<td>" . $value['price'] . "</td>";
                                                		echo "<td>" . $value['url'] . "</td>";
                                                        echo "<td>" . $value['new_url'] . "</td>";
                                                        echo "<td>" . $value['count_clicks'] . "</td>";
                                                        //echo "<td>" . $value['oe'] . "</td>";
                                                        if ($value['oe'] ==1) {
                                                            echo "<td>" . "on" ."</td>";
                                                        }else{
                                                            echo "<td>" .   "OFF" . "</td>";
                                                        }
                                                        echo "<td> <a href='cabinet/vendor?offer_id_unsub=" . $value['id'] . "'>отписаться</a></td>";
                                                        echo "<td> <a href='cabinet/statistics?offer_id=" . $value['offer_id'] . "'>подробнее</a></td>";
                                                	echo "<tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>


                    <?php
                        } /*  --------РЕКЛАМОДАТЕЛЬ форма добавления-------------------*/
                        if ($_SESSION['user']['type_user'] == 0) {?>
                            <h4>Добавить оффер</h4>
                                <form method="post">
                                    <p>Имя</p> 
                                    <input required type="text" name="name">
                                    <p>Цена перехода</p> 
                                    <input required type="number" step="0.1" name="price">
                                    <p>Целевой url</p> 
                                    <input required type="text" name="url"> 
                                    <p>Тема сайта</p> 
                                    <select name="theme">
                                        <option value="0">Соцсети</option>
                                        <option value="1">Путешествия</option>
                                        <option value="2">Работа и образование</option>
                                        <option value="3">Авто и Транспорт</option>
                                        <option value="4">Товары/интернет-магазины</option>
                                    </select> <br><br>
                                    <button class="" type="submit" name="submit">добавить</button>
                                </form>
                        <?php
                        }

                        /*  --------Админ форма изменения коммисси системы-------------------*/
                        if ($_SESSION['user']['type_user'] == 10) {?>
                            <h4>Изменить коммиссию системы</h4>
                                <form method="post">
                                    <input type="number" name="commission" value="<?php echo $pageData['commissionAdmin'] ?>" min="0" max="0.9" step="0.1"><br>
                                    <button class="" type="submit" name="submit">сохранить</button>
                                </form>

                            <h3>Доход системы</h3>
                            <?php   echo "<h4>". $pageData['incomeAdmin'] . "р </h4>" ;?>
                            
                        <?php
                        }
                    ?>


                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<footer style="height: 100px">
		
	</footer>
    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/admin/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/admin/sb-admin-2.js"></script>

</body>

</html>