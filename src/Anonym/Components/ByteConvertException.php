<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;

    use Exception;

    /**
     * Class ByteConvertException
     * @package Anonym\Components\Upload
     */
    class ByteConvertException extends Exception
    {
        /**
         * Sınıfı başlatır ve mesajı basar
         *
         * @param string $message
         */
        public function __construct($message = ''){
            $this->message = $message;
        }

    }