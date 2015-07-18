<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Ftp;

    /**
     * Class FtpConnection
     * @package Anonym\Components\Upload\Ftp
     */

    class FtpConnection
    {
        /**
         * @return bool|resource
         */
        public function getConnect()
        {
            return $this->connect;
        }

        /**
         * @param bool|resource $connect
         */
        public function setConnect($connect)
        {
            $this->connect = $connect;
        }

        /**
         * Bağlantı objesi
         *
         * @var bool|resource
         */
        private $connect;
        /**
         * Ftp kullanıcı adını tutar
         *
         * @var string
         */
        private $username;

        /**
         * Sunucuyu tutar
         *
         * @var string
         */
        private $host;

        /**
         * @return string
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * @param string $username
         */
        public function setUsername($username)
        {
            $this->username = $username;
        }

        /**
         * şifreyi tutar
         *
         * @var string
         */

        private $password;

        /**
         * $connection ile username, password ve host bilgileri alınır.
         *
         * @param array $connection
         */
        public function __construct(array $connection = [])
        {
            $this->setUsername($connection['username']);
            $this->setHost($connection['host']);
            $this->setPassword($connection['password']);
        }

        /**
         * ftp bağlantısı yapılır
         *
         * @return bool|$this
         */
        public function connect()
        {

            $connect = ftp_connect($this->getHost());
            $login = ftp_login($connect, $this->getUsername(), $this->getPassword());

            if(!$login || !$connect){
                return false;
            }else{
                $this->setConnect($connect);
                return $this;
            }

        }

        /**
         * Dosyayı yükler
         *
         * @param string $targetFull
         * @param string $srcFull
         * @return bool
         */
        public function upload($targetFull = '', $srcFull = ''){
            return ftp_put($this->getConnect(), $targetFull, $srcFull, FTP_BINARY);
        }
        /**
         * @return string
         */
        public function getHost()
        {
            return $this->host;
        }

        /**
         * @param string $host
         */
        public function setHost($host)
        {
            $this->host = $host;
        }

        /**
         * @return string
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @param string $password
         */
        public function setPassword($password)
        {
            $this->password = $password;
        }

    }