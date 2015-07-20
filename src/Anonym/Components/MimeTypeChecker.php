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

    class MimeTypeChecker implements CheckerInterface
    {
        /**
         * Yüklenmesine izin verilecek tipler tutulur.
         *
         * @var array|string
         */
        protected $allowedTypes = [];

        /**
         * Mime tipi ni tutar
         *
         * @var
         */
        protected $type;

        public function __construct($allowedTypes = [], $type = '')
        {
            $this->setAllowedMimeTypes($allowedTypes);
            $this->setFileMimeType($type);
        }

        /**
         * tipin atamasını yapar
         *
         * @param string $type
         * @return $this
         */
        public function setFileMimeType($type = '')
        {
            $this->type = $type;
            return $this;
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
        public function getFileMimeType()
        {
            return $this->type;
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
            $fileMimeType = $this->getFileMimeType();
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
