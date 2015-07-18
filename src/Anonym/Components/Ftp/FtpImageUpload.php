<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Ftp;

    /**
     * Class FtpImageUpload
     * @package Anonym\Components\Upload\Ftp
     */

    class FtpImageUpload extends FtpUpload
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
         * Sınıfı başlatır ve ftp ile bağlantı kurar
         *
         * @param array $connection
         * @param array $file
         * @param string $target
         */
        public function __construct(array $connection = [], $file = [], $target = 'upload'){
            parent::__construct($file, $target);
            $this->connection = new FtpConnection($connection);
            $this->connection->connect();
            $this->setAllowedMimeTypes($this->getImageMimeTypes());
            $this->setAllowedExt($this->getImageTypeExt(), '.php');
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
         * @return array
         */
        public function getImageMimeTypes()
        {
            return $this->imageMimeTypes;
        }

        /**
         * @param array $imageMimeTypes
         */
        public function setImageMimeTypes($imageMimeTypes)
        {
            $this->imageMimeTypes = $imageMimeTypes;
        }

    }