<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Ftp;
    use Anonym\Components\Upload\Upload;

    /**
     * Class FtpUpload
     * @package Anonym\Components\Upload\Ftp
     */
    class FtpUpload extends Upload
    {
        public function __construct(array $connection = [], $file = [], $target = 'upload'){
            parent::__construct($file, $target);
        }
    }