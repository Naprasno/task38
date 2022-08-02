<?php 
//print_r ($pageData);
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
                        <li>
                            <a href="/cabinet"><i class="fa fa-cart-plus"></i> Настройки</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <?php /*  --------ВЕБ МАСТЕР -------------------*/
                    if ($_SESSION['user']['type_user'] == 1) { ?>
                        <h4>Посмотреть доходы и кол-во переходов по offer-у <?php echo $pageData['offerName'] ?></h4>
                    <?php } 
                    else {
                        ?>
                        <h4>Посмотреть расходы и кол-во переходов по offer-у <?php echo $pageData['offerName'] ?></h4>
                    <?php }?>    

                    <form method="POST">
                        <p>
                            <label for="date">с: </label>
                            <input type="date" id="date1" name="date1"/>
                        </p>
                        <p>
                            <label for="date">по: </label>
                            <input type="date" id="date2" name="date2"/>
                        </p>
                        <p>
                            <button type="submit" name ='submit'>Посмотреть </button>
                        </p>
                    </form>
                </div>
            </div> 

            <div class="row">
                <table class="table table-bordered table-hover table-striped">

                <?php /*  --------ВЕБ МАСТЕР -------------------*/
                    if ($_SESSION['user']['type_user'] == 1) { ?>
                    <thead>
                        <tr>
                            <th>Кол-во переходов</th>
                            <th>Заработано</th>
                            <th>Выбранный период</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($pageData['getStat'])) {
                            foreach ($pageData['getStat'] as $key => $value) {
                                echo "<tr>";
                                    echo "<td>" . $value['count'] . "</td>";
                                    echo "<td>" . $value['summ'] . "</td>";
                                    echo "<td>" . $value['dates'] . "</td>";
                                    
                                echo "<tr>";
                            }
                         }
                        ?>
                    </tbody>
                <?php }
                /*  --------РЕКЛАМОДАТЕЛЬ -------------------*/
                else{
                ?>
                    <thead>
                        <tr>
                            <th>Кол-во переходов</th>
                            <th>Расходы</th>
                            <th>Выбранный период</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($pageData['getStatAd'])) {
                            foreach ($pageData['getStatAd'] as $key => $value) {
                                echo "<tr>";
                                    echo "<td>" . $value['count'] . "</td>";
                                    echo "<td>" . $value['summ'] . "</td>";
                                    echo "<td>" . $value['dates'] . "</td>";
                                    
                                echo "<tr>";
                            }
                         }
                        ?>
                    </tbody>


                <?php 
                }
                ?>

                </table>
            </row>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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