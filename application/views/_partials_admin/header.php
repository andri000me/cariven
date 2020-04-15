<?php
$query3 = $this->db->query("SELECT * FROM users");
$query4 = $this->db->query("SELECT * FROM publishers");
$query5 = $this->db->query("SELECT * FROM users where role = 'adm'");

$jumlah_user = $query3->num_rows();
$jumlah_publisher = $query4->num_rows();
$jumlah_admin = $query5->num_rows();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator | Cariven</title>

  <link href="<?= base_url('assets/images/images-site/icon.png') ?>" rel="icon">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
