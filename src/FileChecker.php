<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */


    namespace Anonym\Components\Upload;

    class FileChecker implements CheckerInterface
    {

        /**
         * [$allowedExtensions description]
         * @var array|string
         */
         private $allowedExtensions;

         /**
          * [$notAllowedExtensions description]
          * @var array
          */
         private $notAllowedExtensions;


        public function __construct($allowed = '*', $notAllowed = [])
        {
            $this->setAllowedExt($allowed);
            $this->setNotAllowedExt($notAllowed);

        }

        /**
         * Kullanılabilecek uzantıları tutar
         *
         * @param string $allowed
         * @return $this
         */
        public function setAllowedExt($allowed = '*')
        {
            $this->allowedExtensions = $allowed;
            return $this;
        }

        /**
         * Kullanılamıyacak 2. uzantı veya dosya isimlerini tutar
         *
         * @param array $notAllowed
         * @return $this
         */
        public function setNotAllowedExt($notAllowed = []){
            $this->notAllowedExtensions = $notAllowed;
            return $this;
        }

        /**
         *
         *  Kontrolu yapar ve sonucu döndürür
         *
         * @param string $file
         * @return bool
         */
        public function check($file = ''){

        }
    }
