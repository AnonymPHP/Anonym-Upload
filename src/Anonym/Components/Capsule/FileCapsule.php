<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Capsule;

    use ArrayAccess;
    use Anonym\Components\Upload\TargetIsNotReadableException;
    use Anonym\Components\Upload\TargetIsNotWriteableException;

    class FileCapsule implements ArrayAccess
    {

        /**
         * Gönderilen verileri dizi olarak saklar
         *
         * @var array
         */

        protected $capsule;

        /**
         * Dosyanın yolunu tutar
         *
         * @var string
         */
        private $filePath;

        /**
         * Dosyanın ismini tutar
         *
         * @var string
         */
        private $name;

        /**
         * Dosyanın boyutunu tutar
         *
         * @var int
         */
        private $size;

        /**
         *
         *
         * @var string
         */

        private $target;

        /**
         * Dosyanın uzantısını tutar
         *
         * @var string
         */
        private $ext;

        /**
         * Sınıfı başlatır ve kapsül ataması yapar
         *
         * @param array $capsule
         */

        public function __construct(array $capsule = [])
        {

            $this->setCapsule($capsule);
            $this->setCapsuleParams();
            $this->check();
        }

        private function check()
        {
            if (!is_readable($this->getTarget())) {
                throw new TargetIsNotReadableException(
                    sprintf('%s hedefiniz okunmaya karşı korumalı', $this->getTarget())
                );
            }
            if (!is_writeable($this->getTarget())) {
                throw new TargetIsNotWriteableException(
                    sprintf('%s hedefiniz yazmaya karşı korumalı', $this->getTarget())
                );
            }

        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Whether a offset exists
         * @link http://php.net/manual/en/arrayaccess.offsetexists.php
         * @param mixed $offset <p>
         * An offset to check for.
         * </p>
         * @return boolean true on success or false on failure.
         * </p>
         * <p>
         * The return value will be casted to boolean if non-boolean was returned.
         */
        public function offsetExists($offset)
        {
            return isset($this->capsule[$offset]);
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to retrieve
         * @link http://php.net/manual/en/arrayaccess.offsetget.php
         * @param mixed $offset <p>
         * The offset to retrieve.
         * </p>
         * @return mixed Can return all value types.
         */
        public function offsetGet($offset)
        {
            return $this->capsule[$offset];
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to set
         * @link http://php.net/manual/en/arrayaccess.offsetset.php
         * @param mixed $offset <p>
         * The offset to assign the value to.
         * </p>
         * @param mixed $value <p>
         * The value to set.
         * </p>
         * @return void
         */
        public function offsetSet($offset, $value)
        {
            $this->capsule[$offset] = $value;
        }

        /**
         * (PHP 5 &gt;= 5.0.0)<br/>
         * Offset to unset
         * @link http://php.net/manual/en/arrayaccess.offsetunset.php
         * @param mixed $offset <p>
         * The offset to unset.
         * </p>
         * @return void
         */
        public function offsetUnset($offset)
        {
            unset($this->capsule[$offset]);
        }

        /**
         *  Kapsülün içindeki parametreleri kullanır
         */
        private function setCapsuleParams()
        {
            $capsule = $this->getCapsule();

            $this->setExt($capsule['ext']);
            $this->setFilePath($capsule['filepath']);
            $this->setName($capsule['name']);
            $this->setSize($capsule['size']);
            $this->setTarget($capsule['target']);

        }


        /**
         * Dosyayı başka bir yola hareket ettirir
         *
         * @param string $dest
         * @return $this
         */
        public function move($dest = '')
        {
            rename($this->getFilePath(), $dest);
            $this->setFilePath($dest);

            $this->capsule['filepath'] = $dest;
            return $this;
        }

        /**
         * Dosyayı kopyalar
         *
         * @param $dest
         * @return $this
         */
        public function copy($dest)
        {
            copy($this->getFilePath(), $dest);
            return $this;
        }

        /**
         * Dikkat bu işlem dosyayı siler ve bool döndürür, bu işlem tetiklendikden
         * sonra geri dönüşü yoktur.
         *
         * @return bool
         */
        public function delete()
        {
            return unlink($this->getFilePath());
        }

        /**
         * @return array
         */
        public function getCapsule()
        {
            return $this->capsule;
        }

        /**
         * Dizi olarka girilen paremetreyi tutar
         *
         * @param array $capsule
         * @return $this
         */
        public function setCapsule($capsule)
        {
            $this->capsule = $capsule;

            return $this;
        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Dosyanın adını tanımlar
         *
         * @param string $name
         * @return $this
         */
        public function setName($name)
        {
            $this->name = $name;

            return $this;
        }

        /**
         * @return string
         */
        public function getFilePath()
        {
            return $this->filePath;
        }

        /**
         * Dosyanın yolunu tanımlar
         *
         * @param string $filePath
         * @return $this
         */
        public function setFilePath($filePath)
        {
            $this->filePath = $filePath;

            return $this;
        }

        /**
         * Dosyanın kaydedildiği klasörü döndürür
         *
         * @return string
         */
        public function getTarget()
        {
            return $this->target;
        }

        /**
         * Dosyanın kaydedildiği klasörü atar
         *
         * @param string $target
         * @return $this
         */
        public function setTarget($target)
        {
            $this->target = $target;

            return $this;
        }

        /**
         * Dosyanın boyutunu döndürür
         *
         * @return int
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * Dosyanın boyutunu atar
         *
         * @param int $size
         * @return $this
         */
        public function setSize($size)
        {
            $this->size = $size;

            return $this;
        }

        /**
         * Dosyanın uzantısını döndür
         *
         * @return string
         */
        public function getExt()
        {
            return $this->ext;
        }

        /**
         * Dosyanın uzantısını tanımlar
         *
         * @param string $ext
         * @return $this
         */
        public function setExt($ext)
        {
            $this->ext = $ext;

            return $this;
        }
    }
