<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;


    class ByteConvert
    {
        /**
         * Boyutu tutar
         *
         * @var int
         */
        private $size;


        /**
         * Desteklenen tipleri tutar
         *
         * @var array
         */
        private $sizeTypes = [
            'KB' => 1024,
            'MB' => 1024 * 1024,
            'GB' => 1024 * 1024 * 1024,
            'TB' => 1024 * 1024 * 1024 * 1024
        ];


        /**
         * Byte a dönüştürülecek veriyi tutar
         *
         * @var string
         */
        private $byteString;


        /**
         * Tipi tutar
         *
         * @var string
         */
        private $type;

        /**
         * Sınıfı başlatır
         *
         * @param string $string
         */
        public function __construct($string = '')
        {
            $this->setByteString($string);
            $this->findType();
        }



        /**
         * Girilen string değerini byte a çevirir
         *
         * @return int
         */
        public function convertToByte()
        {
            $type = $this->getType();
            $size = $this->getSize();
            $selectedType = $this->sizeTypes[$type];
            return ($selectedType * $size);
        }

        /**
         * @return string
         */
        public function getByteString()
        {
            return $this->byteString;
        }

        /**
         * @param string $byteString
         */
        public function setByteString($byteString)
        {
            $this->byteString = $byteString;
        }

        /**
         * @return string
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param string $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * Dosyanın tipini bulur ve boyutunu ayarlar
         *
         * @throws ByteConvertException
         */
        private function findType()
        {
            $string = $this->getByteString();
            $type = substr($string, -2);
            $type = mb_convert_case($type, MB_CASE_UPPER);

            $size = (int) substr($string, 0, strlen($string) - 2);
            if(isset($this->sizeTypes[$type])){
                $this->setSize($size);
                $this->setType($type);
            }else{
                throw new ByteConvertException(sprintf('%s adında bir dönüştürme tipi bulunamadı', $type));
            }
        }


        /**
         * @return array
         */
        public function getSizeTypes()
        {
            return $this->sizeTypes;
        }

        /**
         * @param array $sizeTypes
         * @return ByteConvert
         */
        public function setSizeTypes($sizeTypes)
        {
            $this->sizeTypes = $sizeTypes;

            return $this;
        }

        /**
         * @return int
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * @param int $size
         * @return ByteConvert
         */
        public function setSize($size)
        {
            $this->size = $size;

            return $this;
        }

    }