<?php
require './db.php';

$conn = OpenCon();
session_start();

$user;

if (isset($_SESSION['user-id'])) {
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = $conn->query($query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('Location: login.php');
    exit;
}


?>

<?php

$QueryProfile = "SELECT * FROM profil";
$ResultProfile = $conn->query($QueryProfile);

// Mengambil data pendidikan
$queryPendidikan = "SELECT * FROM pendidikan";
$resultPendidikan = $conn->query($queryPendidikan);

// Mengambil data pengalaman
$queryPengalaman = "SELECT * FROM pengalaman";
$resultPengalaman = $conn->query($queryPengalaman);

// Mengambil data skill
$querySkill = "SELECT * FROM skill";
$resultSkill = $conn->query($querySkill);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Adli</title>

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
    <a class="navbar-brand" href="#">Aldi Siokain</a>
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
      <a class="buton" href="/porto-php/dashboard.php">LOGIN</a>

    </div>
  </nav>

<!-- navbar end -->



<!-- Hero Section -->
<?php

if ($ResultProfile->num_rows > 0) {
  // Ambil data baris pertama
  $Profile = $ResultProfile->fetch_assoc();
} else {
  // Jika tidak ada hasil, set nilai default atau beri pesan error
  $Profile = [
      "namas" => "Nama Tidak Ditemukan",
      "description" => "Deskripsi tidak tersedia.",
      "image" => "default_image.jpg"
  ];
}

// Data dummy untuk hero section
$hero = [
    "image" => "img/bayu.jpg"
];
?>

<section class="hero-section" id="Home">
    <div class="container">
        <div class="row align-items-center">
            <!-- Bagian Teks -->
            <div data-aos="fade-right" class="col-md-6 text">
                <h1>Welcome To <?php echo $Profile["nama"]; ?> Portfolio</h1>
                <p><?php echo $Profile["deskripsi"]; ?></p>
            </div>

            <!-- Bagian Gambar -->
            <div data-aos="fade-left" class="col-md-6 image text-center">
                <img src="<?php echo $Profile["gambar"]; ?>" alt="Profile Picture" class="img-fluid rounded-circle">
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
 
              if ($resultPendidikan->num_rows > 0) {
                while ($edu = $resultPendidikan->fetch_assoc()){
                  echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                  echo '  <div data-aos="fade-up" class="education-card">';
                  echo '    <h5>' . $edu['lokasi'] . '</h5>';
                  echo '    <p class="year">' . $edu['tahun'] . '</p>';
                  if (isset($edu['pendidikan'])) echo '    <p>Gelarnya: ' . $edu['pendidikan'] . '</p>';
                  echo '  </div>';
                  echo '</div>';
                }
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
            <div class="col-md-8">
            <?php
                if ($resultSkill->num_rows > 0) {
                    while ($row = $resultSkill->fetch_assoc()) {
                        echo '<div data-aos="fade-up" class="skill-item mb-3">';
                        echo '<p><i class="fas fa-check-circle"></i> ' . $row['skill'] . '</p>';
                        echo '<div class="progress">';
                        echo '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $row['presentase'] . '%;" aria-valuenow="' . $row['presentase'] . '" aria-valuemin="0" aria-valuemax="100"></div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Data skill tidak ditemukan.</p>";
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
            if ($resultPengalaman->num_rows > 0) {
                while ($exp = $resultPengalaman->fetch_assoc()) {
                    echo '<div class="timeline-item">';
                    echo '<div class="timeline-dot"></div>';
                    echo '<div data-aos="fade-up" class="timeline-content">';
                    echo '<h4>' . $exp['pengalaman'] . '</h4>';
                    echo '<span class="date">' . $exp['tahun'] . '</span>';
                    echo '<span class="date">' . $exp['kategori'] . '</span>';
                    echo '<p>' . $exp['deskripsi'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Data pengalaman tidak ditemukan.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Pengalaman end -->





<!-- Footer -->
<footer class="footer text-center py-3">
    <p class="mb-0 icon mr-4">© <?php echo $Profile['nama']; ?> </p>
    <a href="https://www.tiktok.com/@<?php echo $Profile['tiktok']; ?>" class="mb-0 icon mr-4">Tiktok</a>
    <a href="https://www.instagram.com/<?php echo $Profile['instagram']; ?>" class="mb-0 icon mr-4">Instagram</a>
    <a href="mailto:<?php echo $Profile['email']; ?>" class="mb-0 icon">Email</a>
</footer>


<!-- Footer -->

<!-- Tombol Go to Top -->
<a href="#" id="goToTopBtn" class="btn btn-primary rounded-circle" style="position: fixed; bottom: 20px; right: 20px; display: none; z-index: 1000;">
    <i class="fas fa-arrow-up"></i>
</a>



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


<script>
  // Mendapatkan elemen tombol
var mybutton = document.getElementById("goToTopBtn");

// Ketika pengguna menggulir 100px dari atas, tombol akan muncul
window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
};

// Ketika tombol diklik, halaman akan scroll kembali ke atas
mybutton.onclick = function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
  return false;
};

</script>

</body>

</html>

<?php $conn->close() ?>