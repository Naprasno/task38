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
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Логин</th>
                                <th>тип</th>
                                <th>активность</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pageData['users'] as $key => $value) {
                                echo "<tr>";
                                    echo "<td>" . $value['id'] . "</td>";
                                    echo "<td>" . $value['login'] . "</td>";
                                    if ($value['type_user'] == 1) {
                                        echo "<td>Веб-мастер</td>";
                                    }else{
                                        echo "<td>Рекламодатель</td>";
                                    }
                                    if ($value['enable'] == 1) {
                                        echo "<td><a href='cabinet/vendor?userUpdate_id=" . $value['id'] . "'>деактивировать</a></td>";
                                    }else{
                                        echo "<td><a href='cabinet/vendor?userUpdate_id=" . $value['id'] . "'>активировать</a></td>";
                                    }
                                    
                                echo "<tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <h4 class="text-left login-title">Авторизовать нового пользователя</h1>

                    <form class="" id="form-signin" name="action" value="register" method="post">
                        <?php if(!empty($pageData['error'])) :?>
                            <p><?php echo $pageData['error']; ?></p>
                        <?php endif; ?>
                        <input type="text"  name="login" id="login" placeholder="Логин" required><br><br>
                        <input type="password" name="password" id="password"  placeholder="Пароль" required><br><br>
                        <select name="type_user">
                            <option value="0">Рекламодатель</option>
                            <option value="1">Веб-мастер</option>
                        </select><br><br><br>
                        <button class="btn" type="submit">Зарегистрировать</button>
                    </form>
            </div>

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