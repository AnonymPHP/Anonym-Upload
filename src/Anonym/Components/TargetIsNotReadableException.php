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

    class TargetIsNotReadableException extends Exception
    {
        /**
         *
         *
         * @param string $message gönderilecek mesaj
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }

    }