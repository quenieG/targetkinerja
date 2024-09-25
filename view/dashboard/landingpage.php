<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>IKU - Landing Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
      .adjusted-image {
        width: 100%; /* Adjust the width as needed */
        height: auto;
        display: block;
        margin: -70px auto 0 auto; /* Move the image up by 30px and center it */
      }

      .logo-without-border {
        border: none;
      }

      .justified-text {
        text-align: justify;
      }

      .centered-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
      }
      
        .expanded-text {
            margin-left: -200px; /* Adjust the value as needed */
            margin-right: -200px; /* Adjust the value as needed */
        }
    </style>
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
          <h1><a href="index.html">Politeknik Negeri Sambas</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="active" href="#footer">About</a></li>
            <li><a href="../auth/register.php">Register</a></li>
            <li><a href="../auth/login.php">Login</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section class="hero-section" id="hero">
      <div class="wave">
        <svg
          width="100%"
          height="355px"
          viewBox="0 0 1920 355"
          version="1.1"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
        >
          <g
            id="Page-1"
            stroke="none"
            stroke-width="1"
            fill="none"
            fill-rule="evenodd"
          >
            <g
              id="Apple-TV"
              transform="translate(0.000000, -402.000000)"
              fill="#FFFFFF"
            >
              <path
                d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
                id="Path"
              ></path>
            </g>
          </g>
        </svg>
      </div>

      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-12 hero-text-image">
            <div class="row">
              <div class="col-lg-8 text-center text-lg-start">
                <h1 data-aos="fade-right">
                  Selamat Datang Di Web Indikator Kinerja Utama
                </h1>
                <p class="mb-5" data-aos="fade-right" data-aos-delay="100">
                  Indikator Kinerja Utama (IKU) adalah alat ukur yang digunakan
                  untuk menilai dan memantau kinerja perguruan tinggi. IKU mencakup berbagai aspek penting 
                  seperti kualitas lulusan, kualitas dosen, dan kualitas kurikulum dan pembelajaran. 
                  Tujuannya adalah untuk memastikan perguruan tinggi fokus pada pencapaian target kinerja yang
                  relevan dengan pengembangan pendidikan tinggi, sehingga dapat meningkatkan kualitas pendidikan,
                  penelitian, dan pengabdian kepada masyarakat.
                </p>
                <p
                  data-aos="fade-right"
                  data-aos-delay="200"
                  data-aos-offset="-500"
                >
                  <a href="../auth/login.php" class="btn btn-outline-white">Login</a>
                </p>
              </div>
              <div class="col-lg-4 iphone-wrap">
                <img
                  src="../../assets/images/iconpoltesa.png"
                  alt="Image"
                  class="adjusted-image"
                  data-aos="fade-right"
                  data-aos-delay="200"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Hero -->

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer" role="contentinfo">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-4 mb-4 mb-md-0 centered-content">
            <h3>Tentang Indikator Kinerja Utama (IKU)</h3>
            <p
              class="mb-5 justified-text expanded-text"
              data-aos="fade-right"
              data-aos-delay="100"
            >
              Terdapat tiga sasaran pengembangan, yaitu, terwujdunya pendidikan tinggi vokasi
              yang berkualitas dan berstandar industri, meningkatnya kompetensi SDM pendidikan
              tinggi vokasi dan termanfaat dalam dunia kerja, meningkatnya kualitas kelembagaan 
              Pendidikan tinggi vokasi. Perguruan tinggi diharapkan memanifestasikan ketiga sasaran 
              ini melalui peningkatan kapasitas dan kualitas proses serta pengelolaan Pendidikan yang 
              bertanggung jawab. Salah satu kunci dalam mengatur kinerja perguruan tinggi yaitu melalui 
              Indikator Kinerja Utama Perguruan Tinggi (IKU) yang ditetapkan melalui Keputusan Menteri 
              Pendidikan, Kebudayaaan, Riset dan Teknologi Nomor 210/M/2023. IKU yang ditetapkan harus 
              mampu fokus terhadap tiga amanat pengembangan tersebut serta penjaminan mutu.
            </p>
            <p class="social">
              <a href="https://www.youtube.com/@politekniknegerisambas"
                ><span class="bi bi-youtube"></span
              ></a>
              <a href="https://www.facebook.com/politekniknegerisambas?mibextid=LQQJ4d"><span class="bi bi-facebook"></span></a>
              <a
                href="https://www.instagram.com/politekniknegerisambas_/?igsh=N21ja3IxdG04NDl2"
                ><span class="bi bi-instagram"></span
              ></a>
            </p>
          </div>
        </div>

        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <p class="copyright">
              &copy; Copyright Indikator Kinerja Utama 2024
            </p>
          </div>
        </div>
      </div>
    </footer>

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
