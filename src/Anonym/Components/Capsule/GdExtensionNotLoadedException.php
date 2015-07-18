<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Capsule;

    use Exception;

    /**
     * Class GdExtensionNotLoadedException
     * @package Anonym\Components\Upload\Capsule
     */
    class GdExtensionNotLoadedException extends Exception
    {

        /**
         * Girilen mesajı bir istisnaya çevirir
         *
         * @param string $message
         */
        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }
