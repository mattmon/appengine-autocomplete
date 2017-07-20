<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>App Engine Search API Demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/search.css">
</head>
<body>

<div class="container" id="main">

    <div class="row">
        <div class="col-md-12">
            <h1><img src="/img/google-app-engine-logo.png" id="gae-logo" /> App Engine Search <span class="hidden-xs">API</span> Demo</h1>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8">
            <h2>What is this?</h2>
            <p>A demonstration of autocomplete using Google App Engine's Search API.</p>
        </div>

    <div class="row">
        <div class="col-md-12">
            <h2><img src="/img/bestbuy.png" id="bb-logo"/>Product Search</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="well">
                <div class="input-group">
                    <form>
                        <input type="text" class="form-control" id="q" name="q" placeholder="Type here for suggestions..." autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="go">Go</button>
                        </span>
                    </form>
                </div>
            </div>
            <p><em>Auto-complete results <span id="ac_hint"></span></em></p>
            <div class="list-group" id="ac_results"></div>
        </div>
        <div class="col-md-8">
            <p><em><span id="fr_hint">Full search results</span></em></p>
            <div class="list-group" id="full_results"></div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/js/search.js"></script>
</body>
</html>

