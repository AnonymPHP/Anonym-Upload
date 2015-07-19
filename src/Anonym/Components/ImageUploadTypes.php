<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;


    /**
     * Class ImageUploadTypes
     * @package Anonym\Components\Upload
     */
    class ImageUploadTypes
    {

        /**
         * Resim yüklerken izin verilecek tipler
         *
         * @var array
         */
        private $imageMimeTypes = [
            'image/png',
            'image/gif',
            'image/jpeg',
            'image/pjpeg'
        ];


        /**
         * İzin verilen uzantıları tutar
         *
         * @var array
         */
        private $imageTypeExt = [
            'png',
            'jpg',
            'gif'
        ];


        /**
         * @return array
         */
        public function getImageTypeExt()
        {
            return $this->imageTypeExt;
        }

        /**
         * @param array $imageTypeExt
         */
        public function setImageTypeExt($imageTypeExt)
        {
            $this->imageTypeExt = $imageTypeExt;
        }


        /**
         * İzin verilen mime tiplerini döndürür
         *
         * @return array
         */
        public function getImageMimeTypes()
        {
            return $this->imageMimeTypes;
        }

        /**
         * İzin verilen uzantıları döndürür
         *
         * @return array
         */
        public function getImageAllowedExt(){
            return $this->imageTypeExt;
        }

    }