<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Multiple;

    use Anonym\Components\Upload\Ftp\FtpImageUpload;

    /**
     * Class FtpMutlipileImage
     * @package Anonym\Components\Upload\Multiple
     */
    class FtpMultipileImage extends MultipileUpload
    {

        private $connection;

        /*
          * Sınıfı başlatır ve bağlantı, dosyalar, hedef gibi ayarları kullanır
          *
          * @param array $connection
          * @param array $files
          * @param string $target
          */
        public function __construct(array $connection = [], array $files = [], $target = '')
        {
            parent::__construct($files, $target);
            $this->setConnection($connection);
        }

        /**
         *
         * Ftp e dosya yükleme işlemini yapar
         *
         * @return array
         */
        public function upload()
        {
            $files = $this->getFiles();
            $response = [];

            foreach ($files as $file) {
                if (!$file instanceof FtpImageUpload) {
                    $file = new FtpImageUpload($this->getConnection(), $file, $this->getTarget());
                }

                $response[] = $file->upload();
            }

            return $response;
        }

        /**
         * @return mixed
         */
        public function getConnection()
        {
            return $this->connection;
        }

        /**
         * @param mixed $connection
         */
        public function setConnection($connection)
        {
            $this->connection = $connection;
        }

    }
