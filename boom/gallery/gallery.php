<div class="gallery_container">
  <header class="gallery_header">
      Gallery
  </header>
  <section class="gallery_section">
    <div class="section_div">
      <?php
        $dir = glob('../res/{*.jpg, *.png}',GLOB_BRACE);
        foreach ($dir as $value) {
      ?>
      <div class="thumbnails">
        <img src="<?php echo $value; ?>" alt="<?php  ?>" width="100px" height="100px">
      </div>
      <?php
        }
      ?>
    </div>
  </section>
  <footer class="gallery_footer">
      All Rights Reserved &copy;
  </footer>
</div>
