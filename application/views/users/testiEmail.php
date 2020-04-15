<!-- Payment Area End -->
<div class='card mb-3 border-primary' style='max-width: 28rem; font-size: 14px;'>
  <h4 class='card-header text-white bg-primary text-center'>Cariven.id</h4>
  <div class='card-body'>
    <h5 class='card-title'><b>Selamat!</b></h5>
    <p style='margin-bottom:10px'>Anda telah terdaftar sebagai peserta untuk mengikuti event :</p>
    <p style='margin-bottom:10px'><strong><?= $email ?></strong></p>
    <table style='margin-bottom:20px'>
        <tr>
            <td style='width: 70px'>Tanggal</td>
            <td style='width: 20px'>:</td>
            <td><?= $subject ?></td>
        </tr>
        <tr>
            <td>Pukul</td>
            <td>:</td>
            <td>19.00 - 23.00</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>:</td>
            <td>Rumah Djoenjing</td>
        </tr>
    </table>
    <p style='margin-bottom:10px'>Kode pendaftaran: <strong><?= ucwords('123456') ?></strong></p>
    <img src='<?= base_url('ev-admin/assets/images/qrcode/S3VIF.png') ?>' width='200rem' height='200rem'> <br>
    <p style='margin-top:10px;margin-bottom:10px'>Informasi lebih lanjut silahkan hubungi kami <a href='#'>Cariven.id</a></p>
  </div>
</div>