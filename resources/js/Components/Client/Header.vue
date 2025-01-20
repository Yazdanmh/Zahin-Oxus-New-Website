<template>
  <!-- header-area -->
  <header>
    <div class="tg-header__top">
      <div class="container custom-container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="tg-header__top-info">
              <ul class="list-wrap">
                <li>
                  <i class="flaticon-placeholder"></i>256 Avenue, Mark Street,
                  NewYork City
                </li>
                <li>
                  <i class="flaticon-envelope"></i
                  ><a href="mailto:info@gmail.com">info@gmail.com</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="tg-header__top-right">
              <ul class="list-wrap">
                <li>
                  <i class="flaticon-telephone"></i
                  ><a href="tel:0123456789">+123 4884 4889</a>
                </li>
                <li>
                  <div class="tg-header__top-social">
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
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
      <div class="container custom-container">
        <div class="row">
          <div class="col-12">
            <div class="tgmenu__wrap">
              <nav class="tgmenu__nav">
                <div class="logo">
                  <a href="index.html"
                    ><img src="/frontend/assets/img/logo/logo.svg" alt="Logo"
                  /></a>
                </div>
                <div
                  class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex"
                >
                  <ul class="navigation">
                    <li
                      class="active menu-item-has-children tg-mega-menu-has-children"
                    >
                      <a href="#">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">Pages</a>
                      <ul class="sub-menu">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="team.html">Team page</a></li>
                        <li><a href="team-details.html">Team Details</a></li>
                        <li><a href="shop.html">Shop page</a></li>
                        <li><a href="shop-details.html">Shop Details</a></li>
                        <li><a href="blog.html">Blog post</a></li>
                        <li>
                          <a href="blog-details.html">Blog post Details</a>
                        </li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">Services</a>
                      <ul class="sub-menu">
                        <li><a href="services.html">Our Services</a></li>
                        <li>
                          <a href="services-details.html">Services Details</a>
                        </li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">Portfolio</a>
                      <ul class="sub-menu">
                        <li><a href="project.html">Portfolio Page</a></li>
                        <li>
                          <a href="project-details.html">Portfolio Details</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                  </ul>
                </div>
                <div class="tgmenu__action">
                  <ul class="list-wrap">
                    <li class="header-search">
                      <a href="javascript:void(0)" class="search-open-btn"
                        ><i class="flaticon-search"></i
                      ></a>
                    </li>
                    <li class="offCanvas-menu">
                      <a href="shop.html" class="menu-tigger">
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </li>
                    <li class="header-btn">
                      <a href="contact.html" class="tg-btn"
                        ><img
                          src="/frontend/assets/img/icons/comment.svg"
                          alt=""
                          class="injectable"
                        />
                        Start Consult</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="mobile-nav-toggler">
                  <i class="tg-flaticon-menu"></i>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Menu  -->
    <div class="tgmobile__menu">
      <nav class="tgmobile__menu-box">
        <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
        <div class="nav-logo">
          <a href="index.html"
            ><img src="/frontend/assets/img/logo/logo.svg" alt="Logo"
          /></a>
        </div>
        <div class="tgmobile__search">
          <form action="#">
            <input type="text" placeholder="Search here..." />
            <button><i class="fas fa-search"></i></button>
          </form>
        </div>
        <div class="tgmobile__menu-outer">
          <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="social-links">
          <ul class="list-wrap">
            <li>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="tgmobile__menu-backdrop"></div>
    <!-- End Mobile Menu -->

    <!-- header-search -->
    <div class="search__popup">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="search__wrapper">
              <div class="search__close">
                <button type="button" class="search-close-btn">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M17 1L1 17"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                    <path
                      d="M1 1L17 17"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                  </svg>
                </button>
              </div>
              <div class="search__form">
                <form action="#">
                  <div class="search__input">
                    <input
                      class="search-input-field"
                      type="text"
                      placeholder="Type keywords here"
                    />
                    <span class="search-focus-border"></span>
                    <button>
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                          stroke="currentColor"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                        <path
                          d="M19.0002 19.0002L17.2002 17.2002"
                          stroke="currentColor"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="search-popup-overlay"></div>
    <!-- header-search-end -->

    <!-- offCanvas-menu -->
    <div class="offCanvas__info">
      <div class="offCanvas__close-icon menu-close">
        <button>
          <img
            src="/frontend/assets/img/icons/times.svg"
            alt=""
            class="injectable"
          />
        </button>
      </div>
      <div class="offCanvas__logo mb-30">
        <a href="index.html"
          ><img src="/frontend/assets/img/logo/logo.svg" alt="Logo"
        /></a>
      </div>
      <div class="offCanvas__content">
        <p>
          Businorem ipsum dolor sit amet cons interdum quam duis variuy time
          honored tradition etting .
        </p>
      </div>
      <div class="offCanvas__img">
        <ul class="list-wrap">
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta01.jpg"
                alt="img"
            /></a>
          </li>
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta02.jpg"
                alt="img"
            /></a>
          </li>
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta03.jpg"
                alt="img"
            /></a>
          </li>
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta04.jpg"
                alt="img"
            /></a>
          </li>
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta05.jpg"
                alt="img"
            /></a>
          </li>
          <li>
            <a href="javascript:void(0)"
              ><img
                src="/frontend/assets/img/images/footer_insta06.jpg"
                alt="img"
            /></a>
          </li>
        </ul>
      </div>
      <div class="offCanvas__side-info">
        <div class="contact-list">
          <i class="flaticon-placeholder"></i>
          <p>Sydney Harbour Circular City of Sydney,Australia.</p>
        </div>
        <div class="contact-list">
          <i class="flaticon-telephone"></i>
          <a href="tel:0123456789">+123 888 9999</a>
        </div>
        <div class="contact-list">
          <i class="flaticon-envelope"></i>
          <a href="mailto:info@beeko.com">info@beeko.com</a>
        </div>
      </div>
      <div class="offCanvas__social">
        <h6 class="title">Follow us</h6>
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
        </ul>
      </div>
    </div>
    <div class="offCanvas__overly"></div>
    <!-- offCanvas-menu-end -->
  </header>
  <!-- header-area-end -->
</template>