<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\Upload\Capsule;

    /**
     * Class ImageCapsule
     * @package Anonym\Components\Upload\Capsule
     */
    class ImageCapsule extends FileCapsule
    {

        /**
         * Sınıfı başlatır ve üst sınıfa parametreleri gönderir
         *
         * @param array $capsule
         */
        public function __construct(array $capsule = [])
        {
            parent::__construct($capsule);
        }

        /**
         * Resmi yeniden boyulandırır
         *
         * @param int $width
         * @param int $height
         * @return $this
         */
        public function reSize($width = 0, $height = 0)
        {
            $this->gdExtensionCheck();
            $dosya = $this->getFilePath();
            list($genislik, $yukseklik) = getimagesize($dosya);


            if (strstr($width, "%")) {
                $width = str_replace("%", "", $width);
                $bolw = (100 / $width);
                $width = ($genislik / $bolw);
            }
            if (strstr($height, "%")) {
                $height = str_replace("%", "", $height);
                $bolh = (100 / $height);
                $height = ($yukseklik / $bolh);
            }
            $hedef = imagecreatetruecolor($width, $height);


            switch ($this->getExt()) {
                case 'png':
                    $kaynak = imagecreatefrompng($dosya);
                    unlink($dosya);
                    imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $width, $height, $genislik, $yukseklik);
                    imagepng($hedef, $dosya, 100);
                    break;
                case 'jpg':
                    $kaynak = imagecreatefromjpeg($dosya);
                    unlink($dosya);
                    imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $width, $height, $genislik, $yukseklik);
                    imagejpeg($hedef, $dosya, 100);
                    break;
                case 'gif':
                    $kaynak = imagecreatefromgif($dosya);
                    unlink($dosya);
                    imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $width, $height, $genislik, $yukseklik);
                    imagegif($hedef, $dosya, 100);
                    break;
            }
            imagedestroy($hedef);
            imagedestroy($kaynak);

            return $this;
        }

        /**
         * Resmi sıkıştırır
         *
         * @param int $quality
         * @return $this
         */
        public function compress($quality)
        {

            $this->gdExtensionCheck();
            $newFile = $this->getFilePath();
            $file = $newFile;

            switch ($this->getExt()) {
                case 'jpg':
                    $img = imagecreatefromjpeg($file);
                    unlink($file);

                    imagejpeg($img, $newFile, $quality);
                    break;
                case 'png':

                    if ($quality > 10) {
                        $quality = ceil(100 / 10);
                    }
                    $img = imagecreatefrompng($file);
                    unlink($file);

                    imagepng($img, $newFile, $quality);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($file);
                    unlink($file);

                    imagepng($img, $newFile);
                    break;
            }
            imagedestroy($img);

            return $this;
        }

        /**
         * Resmi döndürür
         *
         * @param int $x
         * @return $this
         */
        public function rotate($x = 90)
        {
            $this->gdExtensionCheck();

            $file = $this->getFilePath();
            switch ($this->getExt()) {
                case 'png':
                    $kaynak = imagecreatefrompng($file);
                    unlink($file);
                    $rotated = imagerotate($kaynak, $x, 0);
                    imagepng($rotated, $file, 10);
                    break;
                case 'jpg':
                    $kaynak = imagecreatefromjpeg($file);
                    unlink($file);

                    $rotated = imagerotate($kaynak, $x, 0);
                    imagejpeg($rotated, $file, 100);
                    break;
                case 'gif':
                    $kaynak = imagecreatefromgif($file);
                    unlink($file);

                    $rotated = imagerotate($kaynak, $x, 0);
                    imagegif($rotated, $file);
                    break;
            }
            imagedestroy($kaynak);

            return $this;
        }

        /**
         * GD eklentisinin kurulu olup olmadığına bakar
         *
         * @throws GdExtensionNotLoadedException
         */
        private function gdExtensionCheck()
        {
            if (!function_exists('gd_info') || function_exists('imagecreatetruecolor')) {
                throw new GdExtensionNotLoadedException(
                    sprintf('sunucunuzda resimleri işleyecek gd eklentisi kurulu değil')
                );
            }
        }


        /**
         * Dönüştürmekten sonraki değerleri ayarlar
         *
         * @param array $vars
         */
        private function setCovertVars(array $vars = []){
            $this->setExt($vars['ext']);
            $this->capsule['ext'] = $vars['ext'];
            $this->setFilePath($vars['filepath']);
            $this->capsule['filepath'] = $vars['filepath'];
        }


        /**
         * Resmi oluşturur
         *
         * @param $path
         * @return resource
         */
        private function createImageFrom($path){

            $this->gdExtensionCheck();
            switch($this->getExt()){
                case 'jpg':
                     return imagecreatefromjpeg($path);
                    break;
                case 'png':
                    return imagecreatefrompng($path);
                break;
                case 'gif':
                     return imagecreatefromgif($path);
                    break;

                default:
                    return imagecreatefrompng($path);
                break;
            }

        }
        /**
         * Resmi png formatına dönüşütürür
         *
         * @return ImageCapsule
         */
        public function convertToPng(){
            $fileType = 'jpg';
            $target = sprintf(
                '%s/%s.%s',
                $this->getTarget(),
                $this->getName(),
                $fileType
            );
            $image = $this->createImageFrom($this->getFilePath());
            imagejpeg($image, $target, 100);
            imagedestroy($image);
            $this->setCovertVars([
                'ext' => $fileType,
                'filepath' => $target
            ]);
            return $this;
        }
        /**
         * Resmi gif formatına dönüşütürür
         *
         * @return ImageCapsule
         */
        public function convertToGif(){
            $fileType = 'jpg';
            $target = sprintf(
                '%s/%s.%s',
                $this->getTarget(),
                $this->getName(),
                $fileType
            );
            $image = $this->createImageFrom($this->getFilePath());
            imagegif($image, $target, 100);
            imagedestroy($image);
            $this->setCovertVars([
                'ext' => $fileType,
                'filepath' => $target
            ]);
            return $this;
        }

        /**
         * Resmi jpeg formatına dönüştürür
         *
         * @return ImageCapsule
         */
        public function convertToJpeg()
        {

            $fileType = 'png';
            $target = sprintf(
                '%s/%s.%s',
                $this->getTarget(),
                $this->getName(),
                $fileType
            );
            $image = $this->createImageFrom($this->getFilePath());
            imagepng($image, $target, 10);
            imagedestroy($image);
            $this->setCovertVars([
                'ext' => $fileType,
                'filepath' => $target
            ]);
            return $this;
        }

        /**
         * Dosyanın yolunu yazar
         *
         * @return string
         */
        public function __toString()
        {
            return $this->getFilePath();
        }
    }
