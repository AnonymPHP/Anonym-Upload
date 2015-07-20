<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload;


    class Transporter
    {

        /**
         * Dosya arrayı
         *
         * @var array
         */
        private  $file;

        /**
         * Dosyanın yeni adı
         *
         * @var string|NewNameGenerator
         */
        private $newName;

        /**
         * Dosyanın kaydedileceği hedef
         *
         * @var string
         */
        private $target;

        /**
         * Dosyanın uzantısını kaydeder
         *
         * @var string
         */
        private $ext;
        /**
         * Sınıfı başlatır ve ayarlama işlemlerini halleder
         *
         * @param array $file
         * @param string|NewNameGenerator  $newName
         * @param string $target
         * @throws TargetIsNotWriteableException
         */
        public function __construct(array $file, $newName = '', $target = '', $ext = '')
        {
            if(!file_exists($target)){
                mkdir($target);
            }

            chmod($target, 0777);
            if(!is_writeable($target)){
                throw new TargetIsNotWriteableException(sprintf('%s hedefiniz yazdırılabilir bir dosya değil', $target));
            }
            $this->target = $target;
            $this->file = $file;
            $this->newName = $newName;
            $this->ext = $ext;
        }

        /**
         * Dosyayı taşır
         *
         * @return bool
         */
        public function transport(){

            $targetFileName = sprintf('%s/%s.%s', $this->target, $this->newName, $this->ext);
            if(move_uploaded_file($this->file['tmp_name'], $targetFileName)){
                chmod($targetFileName, 0777);
                return $targetFileName;
            }else{
                return false;
            }
        }
    }
