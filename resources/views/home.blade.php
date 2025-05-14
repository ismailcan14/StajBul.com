<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StajBul.com | Geleceğini Şekillendir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        .hero {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
        }

        .hero p {
            font-size: 20px;
            margin-top: 20px;
        }

        .btn-gradient {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            opacity: 0.9;
        }

        .feature-icon {
            font-size: 40px;
            color: #4f46e5;
        }

        footer {
            background-color: #f1f5f9;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #555;
        }

        .testimonial {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .testimonial p {
            font-style: italic;
        }

        .video-section iframe {
            width: 100%;
            height: 350px;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>StajBul.com ile Geleceğini Şekillendir</h1>
            <p>Binlerce şirket ve öğrenciyi bir araya getiren Türkiye'nin en büyük staj platformu</p>
            <a href="/login" class="btn btn-gradient mt-4"><i class="fas fa-sign-in-alt me-2"></i> Giriş Yap</a>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="mb-3 feature-icon"><i class="fas fa-briefcase"></i></div>
                    <h5>Staj İlanları</h5>
                    <p>Alanında lider firmaların staj ilanlarına kolayca ulaşın.</p>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 feature-icon"><i class="fas fa-comments"></i></div>
                    <h5>Anlık Mesajlaşma</h5>
                    <p>Şirketlerle kolayca iletişime geçin ve süreçleri hızlandırın.</p>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 feature-icon"><i class="fas fa-user-check"></i></div>
                    <h5>Takip Sistemi</h5>
                    <p>Başvurularınızı, kabul durumlarını ve staj geçmişinizi tek panelden yönetin.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- VIDEO TANITIM -->
  
    <section class="video-section py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Platformu Tanıtan Kısa Video</h2>

        <video 
            id="hoverVideo"
            playsinline 
            loop 
            controls
            style="max-width: 800px; width: 100%; border-radius: 12px;" 
            preload="metadata"
        >
            <source src="{{ asset('videos/tanıtım.mp4') }}" type="video/mp4">
            Tarayıcınız video etiketini desteklemiyor.
        </video>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('hoverVideo');

        video.addEventListener('mouseenter', () => {
            video.play();
        });

        video.addEventListener('mouseleave', () => {
            video.pause();
            video.currentTime = 0;
        });
    });
</script>




<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Kullanıcılarımız Ne Diyor?</h2>
        <div class="testimonial-carousel d-flex gap-4 px-2" style="overflow: hidden;">
            @php
                $testimonials = [
                    ["text" => "StajBul sayesinde ilk stajımı buldum. Arayüz çok kullanıcı dostu ve şirketlerle iletişim kurmak çok kolaydı.", "author" => "Ayşe, Bilgisayar Mühendisliği"],
                    ["text" => "Birçok başvuru aldık ve doğru adayı kısa sürede bulduk. Kurumsal şirketler için harika bir platform.", "author" => "Mehmet, İnsan Kaynakları Uzmanı"],
                    ["text" => "Başvuru süreci çok kolaydı. Her şey tek panelde yönetilebiliyor.", "author" => "Zeynep, Endüstri Mühendisliği"],
                    ["text" => "Staj sürecimi baştan sona bu platform sayesinde tamamladım.", "author" => "Ali, Yazılım Geliştirici"],
                    ["text" => "Kurumsal firmalara doğrudan ulaşmak çok değerliydi.", "author" => "Elif, İK Yöneticisi"],
                    ["text" => "Öğrencilere büyük kolaylık sağlayan bir sistem. Her şey düşünülmüş.", "author" => "Emre, Akademisyen"],
                    ["text" => "Panel çok akıcı, ilanlar güncel ve sistem güvenli.", "author" => "Merve, İşletme Öğrencisi"]
                ];
            @endphp

            <div class="d-flex" id="testimonialTrack" style="width: max-content; animation: scrollLeft 40s linear infinite;">
                @foreach($testimonials as $item)
                    <div class="testimonial bg-white shadow-sm p-4 rounded mx-2" style="min-width: 320px; max-width: 320px;">
                        <p class="fst-italic">“{{ $item['text'] }}”</p>
                        <strong class="d-block mt-2">- {{ $item['author'] }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
@keyframes scrollLeft {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>

    <!-- HAKKIMIZDA -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Neden StajBul.com?</h2>
            <p class="mb-4">
                Öğrencilerin en doğru staj fırsatlarına ulaşmasını sağlamak için yola çıktık. Akademik geçmişinize uygun
                ilanları kolayca bulabilir, güvenilir şirketlerle doğrudan iletişime geçebilirsiniz. Şirketler ise ihtiyaçlarına
                uygun genç yeteneklere hızlıca ulaşabilir.
            </p>
            <a href="/register/student" class="btn btn-gradient me-2">Öğrenci Kayıt</a>
            <a href="/register/company" class="btn btn-gradient me-2">Şirket Kayıt</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} StajBul.com — Geleceği birlikte inşa ediyoruz.
    </footer>

</body>
</html>
