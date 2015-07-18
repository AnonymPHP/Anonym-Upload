<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;

    
    class MimeTypeChecker
    {
        /**
         * Yüklenmesine izin verilecek tipler tutulur.
         *
         * @var array|string
         */
        protected $allowedTypes = [];

        public function __construct($allowedTypes = [])
        {
            $this->setAllowedMimeTypes($allowedTypes);
        }

        /**
         * Kabul edilen dosya tiplerini döndürür
         *
         * @return array|string
         */
        public function getAllowedMimeTypes()
        {
            return $this->allowedTypes;
        }

        /**
         * Kabul edilen dosya tipleri tutulur
         *
         * @param string $types
         * @return $this|bool
         */
        public function setAllowedMimeTypes($types = '*')
        {
            if(is_string($types))
            {
                if ('*' !== $types) {
                    $types = (array) $types;
                }else{
                    $this->allowedTypes = $types;
                    return $this;
                }
            }

            if(is_array($types))
            {
                $this->allowedTypes = $types;
                return $this;
            }else{
                return false;
            }
        }

        /**
         * Dosyanın tipini döndürür
         *
         * @param string $filePath
         * @return mixed
         */
        public function getFileMimeType($filePath = '')
        {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type =  finfo_file($finfo, $filePath);
            finfo_close($finfo);

            return $type;
        }

        /**
         * Dosya tipini kontrol eder
         *
         * @param string $fileUrl
         * @return bool
         */
        public function check($file = '')
        {
            $types = $this->getAllowedMimeTypes();

            if ($types === '*') {
                return true;
            }

            // dosyanın tipini alıyoruz
            $fileMimeType = $this->getFileMimeType($file);
            foreach($types as $type)
            {
                 if($type === $fileMimeType){
                     return true;
                 }else{
                     continue;
                 }
            }

            return false;
        }
    }