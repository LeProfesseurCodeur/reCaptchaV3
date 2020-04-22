<?php

include("keys.php");


if ($_POST['google-response-token']) {
    $googleToken = $_POST['google-response-token'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$googleToken}");
    $response = json_decode($response);

    $response = (array) $response;

    var_dump($response);


    if ($response['success'] && ($response['score'] && $response['score'] > 0.5)) {
        echo "<div class='alert alert-success'> Validation reussi :) </div>";
    } else {
        echo "<div class='alert alert-danger'> Validation echouee :( </div>";
    }
}
