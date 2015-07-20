
#AnonymUploader
----------------------
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7f50d7f6-8221-4844-afad-4b9a54c3c53d/mini.png)](https://insight.sensiolabs.com/projects/7f50d7f6-8221-4844-afad-4b9a54c3c53d) ![Build Passing](https://img.shields.io/travis/joyent/node/v0.6.svg)   ![Licanse:MIT](https://img.shields.io/packagist/l/doctrine/orm.svg)

---------------------------------------------
AnonymPHP Uploader ile resim ve normal dosyalarınızı tekil ve çoğul olarak basit bir şekilde yapabilirsiniz.

- [AnonymUploader](#)
- [Kurulum](#)
	- [Composer.json dosyası düzenlenmesi](#)
	- [Composer çalıştırılması](#)
	- [Autoload olayının aktif edilmesi](#)
- [Yükleme İşlemleri](#)
	- [Tekil Dosya Yükleme](#)
	- [Tekil Resim Yükleme](#)
	- [Ftp'e Tekil Dosya Yükleme](#)
	- [Ftp'e Tekil Resim Yükleme](#)
	- [Çoğul Dosya Yükleme](#)
	- [Çoğul Resim Yükleme](#)
	- [Ftp 'e Çoğul dosya yüklemek](#)
	- [Ftp 'e Çoğul Resim yüklemek](#)
- [YARDIMCI FONKSİYONLAR](#)
	- [Uzantı Kontrolu ](#)
	- [Mime Tip Kontrolu ](#)
	- [Dosya Boyutu Kontrolu](#)
	- [Dosya İsmini Düzenleme](#)
- [YÜKLEMEDEN SONRAKİ İŞLEMLER](#)
	- [Dosya Bilgilerini Alma](#)
	- [Dosyalarla basit işlemler yapmak](#)
- [Resimlerle Gelişmiş İşlemler Yapmak](#)
	- [PNG FORMATINA DÖNÜŞÜM](#)
	- [JPG FORMATINA DÖNÜŞÜM](#)
	- [GİF FORMATINA DÖNÜŞÜM](#)
	- [Resmi Sıkıştırma](#)
	- [Resmi Döndürme](#)
	- [Resmi Yeniden Boyutlandırma](#)

Sunucunuzun max post ve gd gibi kütüphanelerini ayarlamanız önerilir.

> **Dikkat:**
>Yükleme işlemlerinin başarılı olmasını istiyorsanız dosyalarınızın izinlerini iyi ayarlamalısınız

Kurulum
===================


Anonym Uploader composer autoload sistemi üzerine kuruludur,  composer ile kullanılması önerilir.

Composer.json dosyası düzenlenmesi
--------------------------------------

```
 "require": {
    "anonym-php/anonym-upload": "dev-master"
  }
```

Composer çalıştırılması
-----------------------------

```
composer install
```

Autoload olayının aktif edilmesi
----------------------------

Autoload olayının aktif edilmesi için composer kurulduktan sonra dosyanızda "vendor/autoload.php" include edilmelidir.

```php
include "vendor/autoload.php";
```
Yükleme İşlemleri
=============

Bu kısımda tekil ve çoğul olarak nasıl dosya yükleyebileceğiniz yer almaktadır.

Tekil Dosya Yükleme
-------------------

```php

use Anonym\Components\Upload\FileUpload;

$upload = new FileUpload($_FILES['upload'], 'hedef');
var_dump($upload->upload());

```

Tekil Resim Yükleme
-------------------

```php

use Anonym\Components\Upload\ImageUpload;

$upload = new ImageUpload($_FILES['upload'], 'hedef');
var_dump($upload->upload());

```

Ftp'e Tekil Dosya Yükleme
-------------------
Ftp e tekil dosya yüklerken normal yüklemelerden farklı olarak ilk parametreye ftp bilgilerini girmelisiniz
```php

use Anonym\Components\Upload\Ftp\FtpUpload;

$upload = new FtpUpload([
   'username' => 'ftpkullanıcıadı',
   'password' => 'ftpşifresi',
   'host' => 'ftpsucusu'
],$_FILES['upload'], 'hedef');
var_dump($upload->upload());

```

Ftp'e Tekil Resim Yükleme
-------------------
```php

use Anonym\Components\Upload\Ftp\FtpImageUpload;

$upload = new FtpImageUpload([
   'username' => 'ftpkullanıcıadı',
   'password' => 'ftpşifresi',
   'host' => 'ftpsucusu'
],$_FILES['upload'], 'hedef');
var_dump($upload->upload());
```

Çoğul Dosya Yükleme
-------------------

Çoğul dosya yükleme işleminde dönen veri bir dizi olarak döner ve bunları işlemek size kalır. Örnek olarak;

```php

use Anonym\Components\Upload\Multiple\MultipleUpload;

$upload = new MultipleUpload($_FILES['upload'], 'hedef');
print_r($upload->upload()); // array

```

Çoğul Resim Yükleme
-------------------

Çoğul dosya yükleme işleminde dönen veri bir dizi olarak döner ve bunları işlemek size kalır. Örnek olarak;

```php

use Anonym\Components\Upload\Multiple\MultipleImageUpload;

$upload = new MultipleImageUpload($_FILES['upload'], 'hedef');
print_r($upload->upload()); // array

```
Ftp 'e Çoğul dosya yüklemek
-------------------
Ftp adresine çoğul dosya yüklemek için normal yüklemeden farklı olarak ilrk parametreye ftp bilgilerini girmelisini
```php

use Anonym\Components\Upload\Multipile\FtpMultipileUpload;

$upload = new FtpMultipileUpload([
   'username' => 'ftpkullanıcıadı',
   'password' => 'ftpşifresi',
   'host' => 'ftpsucusu'
],$_FILES['upload'], 'hedef');
print_r($upload->upload()); // array

```

Ftp 'e Çoğul Resim yüklemek
-------------------
Ftp adresine çoğul dosya yüklemek için normal yüklemeden farklı olarak ilrk parametreye ftp bilgilerini girmelisini
```php

use Anonym\Components\Upload\Multipile\FtpMutlipileImage;

$upload = new FtpMutlipileImage([
   'username' => 'ftpkullanıcıadı',
   'password' => 'ftpşifresi',
   'host' => 'ftpsucusu'
],$_FILES['upload'], 'hedef');
print_r($upload->upload()); // array

```


YARDIMCI FONKSİYONLAR
===================

Burada size yükleme yarken yardımcı olacak fonksiyonları bulacaksınız

Uzantı Kontrolu 
-------------------

Bu özellik dosyada olmasını istediğiniz uzantıları kontrol eder, ilk parametre olması gerekenler, ikinci parametrede dosya isminde olmaması gereken uzantılardır, örnek olarak;

```php
$upload->setAllowedExt(['png', 'jpg','gif'],'.php');
```

Mime Tip Kontrolu 
-------------------

Dosyaların sahip olduğu mime tipi'ni denetleyebilirsiniz örnek olarak

```php
$upload->setAllowedMimeTypes(['image/png', 'image/jpeg']);
```

Dosya Boyutu Kontrolu
-------------------

Yükleyeceğiniz dosyaların sahip olabileceği maksimum boyutu kontrol edebilirsiniz.
Parametre olarak eğer byte cinsinden vermek istiyorsanız `integer` bir değer, eğer `mb,kb,gb,tb` gibi değerleri vermek istiyorsanız `string` olarak dosya boyutunun arkasına tipi yazarak girebilirsiniz.

```php
$upload->setMaxSize(1024); // 1024 byte => 1kb
```

-----------

```php
$upload->setMaxSize('1MB'); // 1 mb
```


Dosya İsmini Düzenleme
-------------------

Dosyanın yüklenirken hangi isimle yükleneceğini değiştirebilirsiniz.


```php
$upload->setNewName('yenidosyaismi');
```
-------

Eğer dosya isminin rastgele belirlenmesini istiyor iseniz;

```php
use Anonym\Components\Upload\NewNameGenerator;
$upload->setNewName(new NewNameGenerator());
```
YÜKLEMEDEN SONRAKİ İŞLEMLER
===================

Eğer `FileUpload` veya `ImageUpload` sınıflarıyla yükleme yaptıysanız size `FileCapsule` ve `ImageCapsule` gibi sınıflar döndürecektir, bu sınıflarla ne yapabilirsiniz onlara bakalım.

Dosya Bilgilerini Alma
-------------------
```php 
  $name = $upload->getName(); 
  // dosyanın adını döndürür 
  // örnek:test.png
   $filePath  = $upload->getFilePath(); 
   // dosyanın tüm uzantısını dönrürür
   // örnek :: upload/test.png
   $size = $upload->getSize(); 
   // dosyanın byte tipinindeki boyutunu döndürür
   // örnek : 1001233
   $ext = $upload->getExt();
   // dosyanın uzantısını döndürür
   // örnek : png
   $target = $upload->getTarget();
   // dosyanın kaydedildiği dosyanın yolunu verir
   // örnek : upload

```

--------

Aynı verilere şu şekildede erişebilirsiniz

```php 
  $name = $upload['name'];
  // dosyanın adını döndürür 
  // örnek:test.png
   $filePath  = $upload['filepath'];
   // dosyanın tüm uzantısını dönrürür
   // örnek :: upload/test.png
   $size = $upload['size'];
   // dosyanın byte tipinindeki boyutunu döndürür
   // örnek : 1001233
   $ext = $upload['ext'];
   // dosyanın uzantısını döndürür
   // örnek : png
   $target = $upload['target'];
   // dosyanın kaydedildiği dosyanın yolunu verir
   // örnek : upload

```

Dosyalarla basit işlemler yapmak
-------------------

bu kısımda dosyalarla kopyalama, yer değiştirme ve silme işlemleri vardır

**Dosyayı Kopyalamak**

Bu işlem ilk parametre olarak kopyalanacak yolu alır;

```php
    $upload->copy($target);
```
----------

**Dosyayı Taşımak**

Bu işlem ilk parametre olarak taşınacak yolu alır;

```php
    $upload->move($target);
```

--------

**Dosyayı Silmek**

Bu işlem dosyayı siler ve sınıfı sonlandırır;

```php
    $upload->delete();
```

Resimlerle Gelişmiş İşlemler Yapmak
============

Bu Kısımda `ImageUpload` sınıfı ile yükleme yaptıktan sonra oluşan `ImageCapsule` sınıfıyla yapabileceğiniz resmi sıkıştırma, yeniden boyutlandırma, resmi döndürme ve tip dönüşümleri yer alıcak.

PNG FORMATINA DÖNÜŞÜM
--------------------------------

yüklenen dosyanız .png formatında değilse dosyanızı .png formatına dönüştürebilirsiniz.

```php
    $upload->convertToPng();
```

JPG FORMATINA DÖNÜŞÜM
--------------------------------

yüklenen dosyanız .jpg formatında değilse dosyanızı .png formatına dönüştürebilirsiniz.

```php
    $upload->convertToJpg();
```

GİF FORMATINA DÖNÜŞÜM
--------------------------------

yüklenen dosyanız .gif formatında değilse dosyanızı .png formatına dönüştürebilirsiniz.

```php
    $upload->convertToGif();
```

Resmi Sıkıştırma
-------------------

Dosyayı yükledikden sonra boyutunu küçültmek için sıkıştırabilirsiniz


```php
  $upload->compress(90);
```

paremetre olarak resmin düşürüleceği kaliteyi alır, % lik olarak.

Resmi Döndürme
-------------------

Resmi sağa, sola yukarı,aşağı istediğiniz açıda döndürebilirsiniz.Parametre olarak döndürülecek açıyı alır.

```php
  $upload->rotate(90);
```

Resmi Yeniden Boyutlandırma
-------------------

Resmi yeniden boyutlandırmak için kullanılabilir, ilk parametre olarak genişlik değerini ikinci parametre olarakda yükseklik değerini alır.

```php
  $upload->reSize(400, 500);
```