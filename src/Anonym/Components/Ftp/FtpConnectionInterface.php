<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Ftp;


    interface FtpConnectionInterface
    {

        /**
         * ftp bağlantısı yapılır ve bağlantı objesi döner
         *
         * @return bool|resource
         */
        public function connect();

        /**
         * ftp e dosya yüklemesi yapar
         *
         * @param string $targetFull
         * @param string $srcFull
         * @return mixed
         */
        public function upload($targetFull = '', $srcFull = '');
    }