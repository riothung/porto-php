<?php
require './partials/header.php';





?>

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg my-5">
          <div class="card-header">
            <h4 class="card-title">Edit Profile</h4>
          </div>
          <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
              </div>
              <div class="form-group">
                <label for="age">Umur</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Masukkan umur" required>
              </div>
              <div class="form-group">
                <label for="phone">Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
              </div>
              <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Masukkan username Instagram" required>
              </div>
              <div class="form-group">
                <label for="tiktok">TikTok</label>
                <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="Masukkan username TikTok" required>
              </div>
              <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Masukkan deskripsi diri Anda" required></textarea>
              </div>
              <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
              </div>
              <button type="submit" class="btn btn-success">Edit</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>









<?php require './partials/footer.php'; ?>