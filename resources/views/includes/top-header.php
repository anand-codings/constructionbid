<!DOCTYPE html>
<html>
    <?php
    $current_user = '';
    if (Auth::user()) {
        $current_user = Auth::user();
    }
    ?>
    <head>
        <title>CONSTRUCTION | HOME</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?= asset('userassets/images/fav.png') ?> " />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= asset('public/css/simplePagination.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('userassets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('userassets/css/owl.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset('userassets/css/nice-select.css'); ?>">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/css/intlTelInput.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <link rel="stylesheet" type="text/css" href="<?=asset('userassets/src/css/star-rating-svg.css')?>">
        <link rel="stylesheet" type="text/css" href="<?=asset('userassets/demo/css/demo.css');?>">
        
        <link rel="stylesheet" type="text/css" href="<?= asset('userassets/css/all.css'); ?>">
        <style>
            .error{
                color:red;
            }
        </style>


    </head>