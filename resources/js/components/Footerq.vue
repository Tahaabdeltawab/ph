<template>
  <!-- footer -->
  <div>
    <footer class="section-padding bg-light-theme pt-0 u-line bg-black">
      <div class="container">
        <div class="row">
          <div class="col-xl col-lg-4 col-md-4 col-sm-6">
            <div class="footer-links">
              <div class="appimg">
                <a href="#">
                  <img
                    :src="asset('uploads/Logo.png')"
                    class="img-fluid footer-logo"
                    alt="app logo"
                  />
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl col-lg-4 col-md-4 col-sm-6">
            <div class="footer-contact">
              <h6 class="text-custom-white">{{ $t('Need Help?') }}</h6>
              <ul>
                <li class="fw-600">
                  <span class="text-light-white">{{ $t('Call Us') }}</span><br>
                  <a href="tel:+9647730019492" class="text-custom-white">+(964) 773 001 9492</a>
                </li>
                <li class="fw-600">
                  <span class="text-light-white">{{ $t('Email Us') }}</span><br>
                  <a href="mailto:info@madinaty.com" class="text-custom-white">info@madinaty.com</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl col-lg-4 col-md-4 col-sm-6">
            <div class="footer-links">
              <h6 class="text-custom-white">{{ $t('Get to Know Us') }}</h6>
              <ul>
                <li>
                  <router-link :to="{name: 'agreement'}" class="text-light-white fw-600">{{$t('Usage Agreement')}}</router-link>
                </li>
                <li>
                  <router-link :to="{name: 'privacy'}" class="text-light-white fw-600">{{$t('Privacy Policy')}}</router-link>
                </li>
                <li>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl col-lg-4 col-md-4 col-sm-6">
            <div class="footer-links">
              <h6 class="text-custom-white">{{ $t('Download Apps') }}</h6>
              <div class="appimg">
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.madinatyapp.madinaty">
                  <img
                    :src="asset('images/app-store/playstore.jpg')"
                    class="img-fluid"
                    alt="app logo"
                  />
                </a>
              </div>
              <div class="appimg">
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.madinatyapp.madinaty">
                  <img
                    :src="asset('images/app-store/appstore.jpg')"
                    class="img-fluid"
                    alt="app logo"
                  />
                </a>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="ft-social-media">
              <h6 class="text-center text-light-black">
                {{ $t('Follow us') }}
              </h6>
              <ul>
                <li class="facebook">
                  <a href="#"
                    ><b-icon
                      icon="facebook"
                      fixed-width
                      font-scale="1.5"
                    ></b-icon
                  ></a>
                </li>
                <li class="twitter">
                  <a href="#"
                    ><b-icon
                      icon="twitter"
                      fixed-width
                      font-scale="1.5"
                    ></b-icon
                  ></a>
                </li>
                <li class="instagram">
                  <a href="#"
                    ><b-icon
                      icon="instagram"
                      fixed-width
                      font-scale="1.5"
                    ></b-icon
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright bg-black">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="copyright-text">
              <span class="text-light-white">
                ©<a href="#" class="text-light-white">{{ $t('Madinaty') }}</a> - 2021 | All Right Reserved
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
</template>

<script>
export default {
  name: "Footer",
  data: () => ({
    appName: window.config.appName,
  }),
};
</script>

<style scoped>
.section-padding {
  padding: 20px 0;
}
.footer-logo {
  background: white;
  padding: 10px;
  width: 120px;
}
.copyright .copyright-text {
  justify-content: center;
}

footer .ft-social-media ul li.facebook:hover {
  /* border-color: #3b5998; */
  border-color: #2154c4;
}
footer .ft-social-media ul li.twitter:hover {
  border-color: #1da1f2;
}
footer .ft-social-media ul li.instagram:hover {
  border-color: #f029ad;
}
footer .ft-social-media ul li.facebook:hover a {
  color: #2154c4;
}
footer .ft-social-media ul li.twitter:hover a {
  color: #1da1f2;
}
footer .ft-social-media ul li.instagram:hover a {
  color: #f029ad;
}
</style>
