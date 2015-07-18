<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Multiple;

    use Anonym\Components\Upload\Upload;

    class MultipileUpload
    {

        /**
         * Gönderilen dosyaları depolar
         *
         * @var array
         */
        private $files;

        /**
         * Dosya yolunu tutar
         *
         * @var string
         */
        private $target;

        public function __construct(array $files = [], $target = 'upload'){
            $this->setFiles($files);
            $this->setTarget($target);
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

                if(!$file instanceof Upload)
                {
                    $file = new Upload($file);
                }

                $response[] = $file->upload();
            }

            return $response;
        }

        /**
         * @return array
         */
        public function getFiles()
        {
            return $this->files;
        }

        /**
         * Dosyaların atamasını yapar
         *
         * @param array $files
         * @return $this
         */
        public function setFiles($files)
        {
            $this->files = $files;
            return $this;
        }

        /**
         * @return string
         */
        public function getTarget()
        {
            return $this->target;
        }

        /**
         * @param string $target
         */
        public function setTarget($target)
        {
            $this->target = $target;
        }

    }