<?php
    include '../vendor/autoload.php';
    use Anonym\Components\Upload\ImageUpload;

    $upload = new ImageUpload($_FILES['file']);
    $upload->upload();
