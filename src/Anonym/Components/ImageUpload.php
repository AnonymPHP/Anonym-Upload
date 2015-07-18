<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;
    use Anonym\Components\Upload\Capsule\ImageCapsule;
    /**
     * Class ImageUpload
     * @package Anonym\Components\Upload
     */

    class ImageUpload extends Upload
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
         * Sınıfı başlatır ve resim yüklenebilmesi için gerekli ortamı hazırlar
         *
         * @param array $file
         * @param string $target
         */
        public function __construct(array $file = [], $target = ''){

            parent::__construct($file, $target);
            $this->setAllowedMimeTypes($this->getImageMimeTypes());
            $this->setAllowedExt($this->getImageAllowedExt(), ['.php']);
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

        /**
         *  @return ImageCapsule|bool
         */
        public function upload()
        {
            $upload = parent::upload();

            if($upload){
                $upload = [
                    'filepath' => $upload,
                    'name' => $this->getNewName(),
                    'target' => $this->getTarget(),
                    'ext' => $this->getExt(),
                    'size' => $this->getFile()['size'],
                ];
                return new ImageCapsule($upload);
            }else{
                return false;
            }

        }
    }
