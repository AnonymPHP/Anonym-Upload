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
     * Class FileSizeException
     * @package Anonym\Components\Upload
     */
    class FileSizeException extends Exception
    {

        /**
         * Hatayı çıktılar
         *
         * @param string $message
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }
