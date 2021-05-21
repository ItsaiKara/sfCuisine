<?php
?>
{# {% extends 'base.html.twig' %}  #}

{% block title %}{% endblock %}

{% block body %}
<link rel="stylesheet" href="{{ asset('css/stylesLogin.css')}}">
<title>Authentification</title>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<div class="sidenav">
    <div class="login-main-text">
        <h2>Connexion</h2>
        <p><strong>Merci de remplir le formulaire</strong> <br
            >Vous aurez besoin d'être identifié pour accéder aux fonctionnalités du site </p>
        <a href="{{ path('home') }}">Acceuil</a>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">

            {{ form_start(form) }}
            <div class="form-group">
                <p style="color: darkred">{{ msg }}</p>
                <label>Adresse mail</label>
                {{ form_widget(form.mail) }}
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                {{ form_widget(form.password) }}
            </div>
            <button type="submit" class="btn btn-black">Valider</button
                {{ form_end(form) }}
            <a href="{{ path('signup') }}">Pas encore inscrit?</a>
            <a href="#">Mot de passe oublié?</a>

        </div>
    </div>
</div>
{% endblock %}
