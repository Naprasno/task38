<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	
	<header></header>

	<div id="content">
	<div class="container table-block">
    <div class="row table-cell-block">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Вход в кабинет</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" id="form-signin" method="post">
                    <?php if(!empty($pageData['error'])) :?>
                        <p><?php echo $pageData['error']; ?></p>
                    <?php endif; ?>
                <input type="text" class="form-control" name="login" id="login" placeholder="Логин" required>
                <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
                </form>
            </div>
            <p>У вас нет аккаунта? - <a href="/register">Зарегистрируйтесь!</a></p>
        </div>
    </div>
</div>
	</div>

	<footer>
		
	</footer>


	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/angular.min.js"></script>
	<script src="/js/script.js"></script>


</body>
</html>