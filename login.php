<?php

include("keys.php");

?>

<html lang="fr">

<head>
    <title>reCaptcha-test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="css/style.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>


</head>

<body>
    <header>
        <div class="alert alert-info">
            <h3>Mise en place de Google reCaptcha V3</h3>
        </div>
    </header>

    <section class="col-4 offset-4">
        <form class="p-4" action="files.php" method="post" id="loginForm" style="background-color: rgba(184, 216, 252, 0.6); border-radius: 20px;">
            <div class="form-group">
                <label for="email">Se connecter</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre adresse email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe">
            </div>
            <input type="hidden" name="google-response-token" id="google-response-token">
            <button type="button" onclick="login()" class="btn btn-primary form-control">Entrer</button>
        </form>
        <div id="message" class="text-center"></div>
    </section>
</body>

</html>
<script type="text/javascript">
    function login() {
        var form = $('#loginForm');
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: 'recaptcha.php',
            data: form.serialize(),
            success: function(data) {
                $('#message').empty();
                $('#message').append(data);
            }
        });
    }
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY; ?>', {
                action: 'homepage'
            })
            .then(function(token) {
                $('#google-response-token').val(token);
            });
    });
</script>