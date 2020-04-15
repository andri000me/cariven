<!-- Header -->
<?php 
	$this->load->view('_partials/header');
?>
<!-- End Header -->

<!-- Navbar -->
<?php 
	$this->load->view('_partials/navbar');
?>
<!-- End Navbar -->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
      <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="312px" id="gmap_canvas" src="https://maps.google.com/maps?q=klodran&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/20-off-discount-for-elegant-themes-divi-sale-coupon-code-2019/">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:312px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:312px;width:100%;}</style></div>
            </div>
        </div>
        
        <div class="row">
          <div class="col-lg-3">
            <div class="contact_info">
              <div class="info_item">
                <i class="ti-home"></i>
                <h6>Jawa Tengah, Indonesia</h6>
                <p>Klodran RT 01/RW 08 Colomadu, Karanganyar</p>
              </div>
              <div class="info_item">
                <i class="ti-headphone"></i>
                <h6><a href="#">(+62) 823 8704 5706</a></h6>
                <p>Mon to Fri 9am to 5 pm</p>
              </div>
              <div class="info_item">
                <i class="ti-email"></i>
                <h6><a href="#">dendani3al@gmail.com</a></h6>
                <p>Ditunggu feedbacknya :)</p>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <?php if ($this->session->userdata('msg-success') <> '') { ?>
                <div class="alert alert-primary alert-dismissible fade show" id="success-send" role="alert">
                    <?= $this->session->userdata('msg-success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <form action="<?= site_url('Inbox/sendInbox') ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required/>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required/>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="2" placeholder="Message"></textarea>
                </div>
                <div class="text-center"><button type="submit" class="btn primary-btn" title="Send Message">Send Message</button></div>
            </form>
        </div>
      </div>
    </section>
    <!--================Contact Area =================-->


<!-- Footer -->
<?php 
	$this->load->view('_partials/footer');
?>
<!-- End Footer -->

<!-- JS -->
<?php 
	$this->load->view('_partials/js');
?>
<!-- End JS -->
<script>
$("#success-send").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-send").slideUp(500);
});
</script>
<!-- Footer -->
<?php 
	$this->load->view('_partials/endfile');
?>
<!-- End Footer -->