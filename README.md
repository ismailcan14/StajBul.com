# 🎓 StajBul.com

StajBul.com, öğrencilerin staj ilanlarına başvurduğu, şirketlerin stajyer aradığı ve admin paneliyle sistemin yönetildiği bir Laravel tabanlı staj takip platformudur.

## 📌 Proje Amacı

Üniversite öğrencilerinin kendilerine uygun staj ilanlarını inceleyip başvuru yapabildiği; şirketlerin ilan oluşturup başvuruları değerlendirdiği ve süreçlerin şeffaf bir şekilde yönetilebildiği modern bir web uygulamasıdır.

## 🛠 Kullanılan Teknolojiler

- **Laravel 10/11** – PHP tabanlı MVC framework
- **MySQL** – Veritabanı yönetimi
- **Blade** – Laravel'in template motoru
- **Bootstrap 5** – Responsive arayüz
- **Font Awesome** – İkon seti
- **SweetAlert2** – Uyarı ve bildirim pencereleri
- **Custom CSS/JS** – Gelişmiş görünüm ve etkileşimler

## 👥 Kullanıcı Rolleri

1. **Öğrenci**
    - Staj ilanlarını inceleyip başvuru yapabilir.
    - Başvuru durumunu takip eder.
    - Kabul edilen başvuruyu onaylayarak staj başlatır.
    - Staj tamamlandığında rapor görüntüleyebilir.
    - Mesajlaşma sistemi ile şirketle iletişime geçebilir.

2. **Şirket**
    - Staj ilanı oluşturur, düzenler veya siler.
    - Başvuruları inceler, kabul veya reddeder.
    - Öğrencinin başlatılan stajını tamamlayabilir.
    - Tamamlanan staj raporlarını yükleyebilir.
    - Mesajlaşma sistemi ile öğrenciyle iletişim kurar.
    - Profil bilgilerini güncelleyebilir (logo dahil).

3. **Admin**
    - Onay bekleyen ilanları inceleyip onaylar veya reddeder.
    - Tüm kullanıcıları (öğrenci ve şirket) listeleyip silebilir.
    - Oturum süresi gibi sistem ayarlarını düzenleyebilir.
    - Panel üzerinden genel istatistikleri takip edebilir.

## ⚙️ Kurulum Talimatları
1) Bağımlılıkları Kur

composer install
npm install && npm run dev

2) Ortam Dosyasını Ayarla
cp .env.example .env
php artisan key:generate

3) .env dosyasına veritabanı bilgilerini gir
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stajbul
DB_USERNAME=root
DB_PASSWORD=

4) Migration & Seeder
php artisan migrate --seed

5) Projeyi Başlat
php artisan serve

## 🛠 Güvenlik Özellikleri
SQL Injection’a karşı Eloquent ORM ve Request validasyonu kullanıldı.

CSRF koruması tüm formlarda aktif (@csrf).

Route middleware ile yetkisiz erişim önlendi:

checkRole:admin

checkRole:student

checkRole:company

“Beni Hatırla” özelliği session yönetimiyle sağlandı.

Dosya yükleme işlemlerinde MIME ve boyut doğrulaması yapıldı.

## Lisans
Bu proje bir ders projesidir ve yalnızca eğitim amaçlı geliştirilmiştir.


### 1. Projeyi Klonla
```bash
git clone https://github.com/ismailcan14/stajbul.git
cd stajbul
