<template>
  <!-- footer-area -->
  <footer class="footer__area fix">
    <div class="footer__top">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="footer__widget">
              <div class="footer__logo">
                <a href="index.html"
                  ><img :src="'/storage/' + props.setting.site_logo" alt="logo" style="max-width:70px;"
                /></a>
              </div>
              <div class="footer__content">
                <p>
                  Felis consquat magnis fames sagittis ultrices plasodales
                  porttitor quisque ultrice tempor turpis.
                </p>
              </div>
              <div class="footer__social">
                <ul class="list-wrap">
                  <li>
                    <a href="https://www.facebook.com/" target="_blank"
                      ><img
                        src="/frontend/assets/img/icons/facebook.svg"
                        alt=""
                        class="injectable"
                    /></a>
                  </li>
                  <li>
                    <a href="https://x.com/home" target="_blank"
                      ><img
                        src="/frontend/assets/img/icons/twitter.svg"
                        alt=""
                        class="injectable"
                    /></a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/" target="_blank"
                      ><img
                        src="/frontend/assets/img/icons/instagram.svg"
                        alt=""
                        class="injectable"
                    /></a>
                  </li>
                  <li>
                    <a href="https://www.pinterest.com/" target="_blank"
                      ><img
                        src="/frontend/assets/img/icons/pinterest.svg"
                        alt=""
                        class="injectable"
                    /></a>
                  </li>
                  <li>
                    <a href="https://www.youtube.com/" target="_blank"
                      ><img
                        src="/frontend/assets/img/icons/youtube.svg"
                        alt=""
                        class="injectable"
                    /></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="footer__widget">
              <h4 class="footer__widget-title">About Company</h4>
              <ul class="footer__widget-link list-wrap">
                <li><a href="about.html">About Us</a></li>
                <li><a href="about.html">Sustainability</a></li>
                <li><a href="about.html">Leadership</a></li>
                <li><a href="about.html">Team News & Media</a></li>
                <li><a href="about.html">Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
            <div class="footer__widget">
              <h4 class="footer__widget-title">Quick links</h4>
              <ul class="footer__widget-link list-wrap">
                <li><a href="about.html">How it’s Work</a></li>
                <li><a href="contact.html">Partners</a></li>
                <li><a href="contact.html">Testimonials</a></li>
                <li><a href="project.html">Case Studiesa</a></li>
                <li><a href="contact.html">Pricing</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-8">
            <div class="footer__widget">
              <h4 class="footer__widget-title">Subscribe Newsletter</h4>
              <div class="footer__newsletter">
                <span>*Only valuable resource no bullshit</span>
                <form action="#" class="footer__newsletter-form">
                  <input type="text" placeholder="Enter your e-mail" />
                  <button type="submit">
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                    />
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="copyright__content">
              <p>Copyright © Beeko | All Right Reserved</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__shape-wrap">
      <img
        src="/frontend/assets/img/images/footer_shape01.svg"
        alt="shape"
        data-aos="fade-down-left"
        data-aos-delay="400"
      />
      <img src="/frontend/assets/img/images/footer_shape02.svg" alt="shape" />
      <img
        src="/frontend/assets/img/images/footer_shape03.svg"
        alt="shape"
        class="rotateme"
      />
    </div>
  </footer>
  <!-- footer-area-end -->
</template>

<script setup>
const props = defineProps({
    setting:{
        type:Object, 
        required:true, 
    }
})
</script>