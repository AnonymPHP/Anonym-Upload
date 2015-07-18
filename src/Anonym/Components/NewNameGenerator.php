<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;

    /**
     * Class NewNameGenerator
     * @package Anonym\Components\Upload
     */

    class NewNameGenerator
    {
        /**
         * Güvenlik kodu tutulur
         *
         * @var string
         */
        private $securityKey;

        /**
         *
         * @var string
         */
        private $ext;
        /**
         * Yeni dosya isminin oluşturulabilmesi için güvenlik kodunu oluşturur
         */
        public function __construct($ext = '')
        {
            $remote = $_SERVER['REMOTE_ADDR'];
            $server = $_SERVER['SERVER_ADDR'];
            $this->securityKey = md5($remote.$server);
            $this->ext= $ext;
        }

        /**
         * Yeni dosya ismini oluşturur
         *
         * @return string
         */
        public function __toString()
        {
            return substr($this->securityKey, rand(0,15), rand(15, 25));
        }
    }
