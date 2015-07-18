<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Multiple;

    use Anonym\Components\Upload\ImageUpload;

    /**
     * Class MultipileImageUpload
     * @package Anonym\Components\Upload\Multiple
     */
    class MultipileImageUpload extends MultipileUpload
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
         * Sınıfı başlatır ve üst sınıfı başlatır
         *
         * @param array $files
         * @param string $target
         */
        public function __construct(array $files = [], $target = ''){
            parent::__construct($files, $target);

        }

        /**
         * Dosyaları yükler
         *
         * @return array
         */
        public function upload()
        {
            $files = $this->getFiles();
            $response = [];

            foreach($files as $file){

                if(!$file instanceof ImageUpload)
                {
                    $file = new ImageUpload($file);
                    $file->setAllowedMimeTypes($this->getImageMimeTypes());
                    $file->setAllowedExt($this->getImageTypeExt(), ['.php']);
                }

                $response[] = $file->upload();
            }

            return $response;
        }

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