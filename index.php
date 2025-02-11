<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Porto Aldy</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="page-top">

<!-- navbar -->
<nav data-aos="fade-down" class="navbar navbar-expand-lg navbar-light container">
    <a class="navbar-brand" href="#">Aldy Porto</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto mr-auto ">
        <a class="nav-link mr-5" href="#Home">Home </a>
        <a class="nav-link mr-5" href="#Pendidikan">Pendidikan</a>
        <a class="nav-link mr-5" href="#skill">Skill</a>
        <a class="nav-link mr-5" href="#Pengalaman">Pengalaman</a>
      </div>
      <a class="buton" href="" >LOGIN</a>
    </div>
  </nav>

<!-- navbar end -->



<!-- Hero Section -->
<?php
// Data dummy untuk hero section
$hero = [
    "title" => "Welcome to My Portfolio",
    "description" => "This is where I showcase my projects, skills, and experience. Feel free to explore and connect with me!",
    "image" => "img/bayu.jpg"
];
?>

<section class="hero-section" id="Home">
    <div class="container">
        <div class="row align-items-center">
            <!-- Bagian Teks -->
            <div data-aos="fade-right" class="col-md-6 text">
                <h1><?php echo $hero["title"]; ?></h1>
                <p><?php echo $hero["description"]; ?></p>
            </div>

            <!-- Bagian Gambar -->
            <div data-aos="fade-left" class="col-md-6 image text-center">
                <img src="<?php echo $hero["image"]; ?>" alt="Profile Picture" class="img-fluid rounded-circle">
            </div>
        </div>
    </div>
</section>

<!-- Hero Section end -->


<!-- Pendidikan -->
<section class="education-section" id="Pendidikan">
    <div class="container">
        <div class="education-title text-white text-center">
            <h2>Pendidikan Saya</h2>
            <p>Berikut adalah latar belakang pendidikan saya sepanjang perjalanan akademik.</p>
        </div>

        <div class="row">
            <?php
            $educations = [
                [
                    "nama" => "Universitas Citra Bangsa",
                    "tahun" => "2020 - 2024",
                    "gelar" => "Sarjana Komputer (S.Kom)",
                    "jurusan" => "Teknik Informatika",
                    "deskripsi" => "Fokus pada pengembangan perangkat lunak dan kecerdasan buatan."
                ],
                [
                    "nama" => "SMA Negeri 1 Kupang",
                    "tahun" => "2017 - 2020",
                    "jurusan" => "Ilmu Pengetahuan Alam (IPA)",
                    "deskripsi" => "Belajar berbagai mata pelajaran dasar yang membentuk dasar pengetahuan sains dan teknologi."
                ],
                [
                    "nama" => "SMP Negeri 5 Kupang",
                    "tahun" => "2014 - 2017",
                    "deskripsi" => "Menimba ilmu dasar sebelum melanjutkan ke pendidikan menengah atas."
                ]
            ];

            foreach ($educations as $edu) {
                echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                echo '  <div data-aos="fade-up" class="education-card">';
                echo '    <h5>' . $edu['nama'] . '</h5>';
                echo '    <p class="year">' . $edu['tahun'] . '</p>';
                if (isset($edu['gelar'])) echo '    <p>Gelarnya: ' . $edu['gelar'] . '</p>';
                if (isset($edu['jurusan'])) echo '    <p>Jurusan: ' . $edu['jurusan'] . '</p>';
                echo '    <p>' . $edu['deskripsi'] . '</p>';
                echo '  </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#d84040" fill-opacity="1" d="M0,128L48,154.7C96,181,192,235,288,234.7C384,235,480,181,576,170.7C672,160,768,192,864,202.7C960,213,1056,203,1152,192C1248,181,1344,171,1392,165.3L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<!-- Pendidikan end -->



<!-- skill -->
<section class="skills-section" id="skill">
    <div class="container">
        <div class="skill-title text-center">
            <h2>Keahlian Saya</h2>
            <p>Berikut adalah keterampilan saya.</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php
                // Data dummy tanpa database
                $skills = [
                    ["skill_name" => "HTML & CSS", "percentage" => 10],
                    ["skill_name" => "JavaScript", "percentage" => 85],
                    ["skill_name" => "ReactJS", "percentage" => 80],
                    ["skill_name" => "PHP", "percentage" => 75],
                    ["skill_name" => "Bootstrap", "percentage" => 85],
                    ["skill_name" => "MySQL", "percentage" => 70],
                ];

                $count = 0;
                foreach ($skills as $row) {
                    if ($count % 3 == 0 && $count > 0) {
                        echo '</div><div class="col-md-6">';
                    }
                    echo '<div data-aos="fade-up" class="skill-item mb-3">';
                    echo '<p><i class="fas fa-check-circle"></i> ' . $row['skill_name'] . '</p>';
                    echo '<div class="progress">';
                    echo '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $row['percentage'] . '%;" aria-valuenow="' . $row['percentage'] . '" aria-valuemin="0" aria-valuemax="100"></div>';
                    echo '</div>';
                    echo '</div>';
                    $count++;
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- skill end -->

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#d84040" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,218.7C672,203,768,149,864,117.3C960,85,1056,75,1152,85.3C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<!-- Pengalaman  -->
<section class="experience-section py-5" id="Pengalaman">
    <div class="container">
        <div class="section-title text-center mb-5 text-white">
            <h2 >Pengalaman Saya</h2>
            <p>Berikut adalah pengalaman kerja dan proyek yang pernah saya kerjakan.</p>
        </div>

        <div class="timeline">
            <?php
            // Data pengalaman (Dummy)
            $experiences = [
                [
                    "title" => "Front-End Developer - Web.it Kupang",
                    "date" => "2024 - Sekarang",
                    "description" => "Mengembangkan aplikasi restoran menggunakan PHP, serta membuat web portfolio dengan ReactJS dan Tailwind CSS."
                ],
                [
                    "title" => "Internship - BAWASLU Kota Kupang",
                    "date" => "Agustus - September 2023",
                    "description" => "Membangun aplikasi pengaduan masyarakat menggunakan Laravel."
                ],
                [
                    "title" => "Freelance Web Developer",
                    "date" => "2022 - Sekarang",
                    "description" => "Membuat berbagai proyek web untuk klien menggunakan ReactJS, Bootstrap, dan Tailwind CSS."
                ]
            ];

            foreach ($experiences as $exp) {
                echo '<div class="timeline-item">';
                echo '<div class="timeline-dot"></div>';
                echo '<div data-aos="fade-up" class="timeline-content">';
                echo '<h4>' . $exp['title'] . '</h4>';
                echo '<span class="date">' . $exp['date'] . '</span>';
                echo '<p>' . $exp['description'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Pengalaman end -->




<!-- Footer -->
<footer class="footer text-center py-3">
    <p class="mb-0">© 2025 Bayu Husada</p>
</footer>

<!-- Footer -->



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
        });
    </script>

</body>

</html>