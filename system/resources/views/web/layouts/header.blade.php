
    <div id="top-bar" class="top-bar">
        <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                <ul class="top-info text-center text-md-left">
                    <li><i class="fas fa-map-marker-alt"></i> <p class="info-text">Judiciary Complex, Khyber Road, Peshawar, Khyber Pakhtunkhwa</p>
                    </li>
                </ul>
              </div>
              <!--/ Top info end -->
  
              <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                <ul class="list-unstyled">
                    <li>
                      <a title="Facebook" target="_blank" href="https://www.facebook.com/MineralsKPGovt">
                          <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                      </a>
                      <a title="Twitter" target="_blank" href="https://twitter.com/mineralskpgovt?lang=en">
                          <span class="social-icon"><i class="fab fa-twitter"></i></span>
                      </a>
                    </li>
                </ul>
              </div>
              <!--/ Top social end -->
          </div>
          <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </div>
    <!--/ Topbar end -->
<!-- Header start -->
<header id="header" class="header-one">
  <div class="bg-white">
    <div class="container">
      <div class="logo-area">
          <div class="row align-items-center">
            <div class="logo col-lg-12 text-center text-lg-left mb-12 mb-md-12 mb-lg-12">
                <table>
                  <tr>
                    <td style="vertical-align: middle;">
                      <a class="d-block" href="/">
                        <img loading="lazy" src="{{asset('assets/images/logo.png')}}" alt="Constra">
                      </a>
                    </td>
                    <td style="vertical-align: middle;">
                      <h1 class="title">
                        <span style="color:green;">MINERALS DEVELOPMENT DEPARTMENT</span> <br><span style="color:grey; font-size:20px;">Government of Khyber Pakhtunkhwa</span>
                      </h1>
                    </td>
                  </tr>
                </table>
            </div><!-- logo end -->
  
            <div class="col-lg-9 header-right">
                <ul class="top-info-box">
                  {{-- <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Call Us</p>
                          <p class="info-box-subtitle"><a href="tel:(+9) 847-291-4353">(+92) 9210317</a></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Email Us</p>
                          <p class="info-box-subtitle"><a href="mailto:office@Constra.com">dgmm@gmail.com</a></p>
                      </div>
                    </div>
                  </li> --}}
                  {{-- <li class="header-get-a-quote">
                    <a class="btn btn-primary" href="https://portal.kpminerals.gov.pk/Portal/CustomHtml.aspx?PageID=d7f3f61d-4689-4280-a59a-b865f002dd60">KP Minerals</a>
                  </li> --}}
                </ul><!-- Ul end -->
            </div><!-- header right end -->
          </div><!-- logo area end -->
  
      </div><!-- Row end -->
    </div><!-- Container end -->
  </div>

  <div class="site-navigation">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div id="navbar-collapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav mr-auto">

                    <li class="nav-item"><a class="nav-link" href="{{url('')}}">Home</a></li>
                      
                    <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Investment <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a target="_blank" href="https://portal.kpminerals.gov.pk/Portal/CustomHtml.aspx?PageID=d7f3f61d-4689-4280-a59a-b865f002dd60">Mining Cadastral Portal</a></li>
                            <li><a target="_blank" href="https://kpdgmm.gov.pk/">Auction Portal</a></li>
                            <li><a href="{{url('investment/black-listed')}}">Black Listed Investor</a></li>
                            <li><a href="{{url('investment/defaulter-list')}}">Defaulter List</a></li>
                            <li><a href="{{url('investment/kp-minerals-potential')}}">KP Minerals Potential</a></li>
                            <li><a href="{{url('investment/sample-test')}}">Sample Test</a></li>
                            {{-- <li><a href="#">Submit Appeals</a></li> --}}
                          </ul> 
                      </li>

                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Library <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('library/geological-reports')}}">Geological Reports</a></li>
                            <li><a href="{{url('library/mtc-minutes')}}">MTC Minutes</a></li>
                            <li><a href="{{url('library/rules-and-policies')}}">Policies and Rules</a></li>
                            <li><a href="{{url('library/notification')}}">Notification</a></li>
                            <li><a href="{{url('library/forms-and-templates')}}">Forms & Templates</a></li>
                          </ul> 
                      </li>

                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Announcements <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('news')}}">News</a></li>
                            <li><a href="{{url('tenders')}}">Tenders</a></li>
                            <li><a href="{{url('auctions')}}">Auctions</a></li>
                          </ul> 
                      </li>

                            
                      <li class="nav-item"><a class="nav-link" href="{{url('appellate-tribunal')}}">Appellate Tribunal</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{url('contact-us')}}">Contact Us</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{url('about-us')}}">About Us</a></li>
                    </ul>
                </div>
              </nav>
          </div>
          <!--/ Col end -->
        </div>
        <!--/ Row end -->

        <!-- <div class="nav-search">
          <span id="search"><i class="fa fa-search"></i></span>
        </div> -->
        <!-- Search end -->

        <!-- <div class="search-block" style="display: none;">
          <label for="search-field" class="w-100 mb-0">
            <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
          </label>
          <span class="search-close">&times;</span>
        </div> -->
        <!-- Site search end -->
    </div>
    <!--/ Container end -->

  </div>
  <!--/ Navigation end -->
</header>
<!--/ Header end -->