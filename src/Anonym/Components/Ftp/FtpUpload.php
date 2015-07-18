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

        /**
         * Bağlantı objesi tutulur
         *
         * @var FtpConnection
         */
        protected $connection;

        /**
         * Sınıfı başlatır ve ftp ile bağlantı kurar
         *
         * @param array $connection
         * @param array $file
         * @param string $target
         */
        public function __construct(array $connection = [], $file = [], $target = 'upload'){
            parent::__construct($file, $target);
            $this->connection = new FtpConnection($connection);
            $this->connection->connect();
        }

        /**
         * Dosyanın yüklemesini gerçekleştirir
         *
         * @return bool
         */
        public function upload(){
            return $this->uploadFtp($this->connection);
        }
    }
