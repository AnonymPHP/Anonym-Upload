<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;


    use Anonym\Components\Upload\Capsule\FileCapsule;

    /**
     * Class FileUpload
     * @package Anonym\Components\Upload
     */

    class FileUpload extends Upload
    {

        /**
         * Sınıfı başlatır ve üst sınıfı başlatır
         *
         * @param array $file
         * @param string $target
         */
        public function __construct(array $file = [], $target = 'upload')
        {
            parent::__construct($file, $target);
        }

        /**
         * Yükleme işlemini gerçekleştirir
         *
         *  @return FileCapsule|bool
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
                return new FileCapsule($upload);
            }else{
                return false;
            }
        }
    }
