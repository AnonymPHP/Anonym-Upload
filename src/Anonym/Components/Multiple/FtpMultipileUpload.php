<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Multiple;


    use Anonym\Components\Upload\Ftp\FtpUpload;

    class FtpMultipileUpload extends MultipileUpload
    {

        /**
         * Bağlantı bilgilerini tutar
         *
         * @var array
         */
        private $connection;

        /**
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
                if (!$file instanceof FtpUpload) {
                    $file = new FtpUpload($this->getConnection(), $file, $this->getTarget());
                }

                $response[] = $file->upload();
            }

            return $response;
        }

        /**
         * @return array
         */
        public function getConnection()
        {
            return $this->connection;
        }

        /**
         * @param array $connection
         */
        public function setConnection($connection)
        {
            $this->connection = $connection;
        }
    }
