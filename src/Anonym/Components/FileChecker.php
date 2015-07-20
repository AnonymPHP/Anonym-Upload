<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */


    namespace Anonym\Components\Upload;
    use Anonym\Components\Upload\CheckerInterface;
    /**
     * Class FileChecker
     * @package Anonym\Components\Upload
     */
    class FileChecker implements CheckerInterface
    {
        /**
         * [$allowedExtensions description]
         * @var array|string
         */
         private $allowedExtensions;

        /**
         * Dosyanın uzantısını tutar
         *
         * @var
         */
        private $ext;
         /**
          * [$notAllowedExtensions description]
          * @var array|string
          */
         private $notAllowedExtensions;


        public function __construct($allowed = '*', $notAllowed = [], $ext = '')
        {
            $this->setAllowedExt($allowed);
            $this->ext = $ext;
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
         * Kullanılmasına izin verilen tipler
         *
         * @return array|string
         */
        public function getAllowedExt()
        {
            return $this->allowedExtensions;
        }

        /**
         * Kullanılmasına izin verilmeyen tipler, isimler
         *
         * @return array|string
         */
        public function getNotAllowedExt()
        {
            return $this->notAllowedExtensions;
        }
        /**
         *
         *  Kontrolu yapar ve sonucu döndürür
         *
         * @param string $file
         * @return bool
         */
        public function check($file = ''){


            if (strstr($file, '/')) {
                $file = end(explode('/',$file));
            }

            $ext = $this->ext;

            if($this->checkAllowedTypes($ext) && $this->checkNotAllowedTypes($file))
            {
                return true;
            }else{
                return false;
            }
        }

        /**
         * Kullanılmasına izin verilen tipleri denetler
         *
         * @param string $ext
         * @return bool
         */
        private function checkAllowedTypes($ext = ''){

            $allowedTypes = $this->getAllowedExt();

            if ('*' === $allowedTypes) {
                return true;
            }else{

              if(is_string($allowedTypes))
              {
                  $allowedTypes = (array) $allowedTypes;
              }

                foreach($allowedTypes as $type)
                {

                    if($type === $ext)
                    {
                      return true;
                    }else{
                        continue;
                    }
                }
            }
            return false;
        }

        /**
         * Kullanılması desteklenmeyen tipler
         *
         * @param string $file
         * @return bool
         */
        private function checkNotAllowedTypes($file = '')
        {
            $notAllowedTypes = $this->getNotAllowedExt();

            if ('*' === $notAllowedTypes) {
                return true;
            }

            if(is_string($notAllowedTypes))
            {
                $notAllowedTypes = (array) $notAllowedTypes;
            }

            foreach($notAllowedTypes as $type){
                $type = '.'.$type;
                if(strstr($file, $type)){
                    return false;
                }else{
                    continue;
                }
            }

            return true;
        }
    }
