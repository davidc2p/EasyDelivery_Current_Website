<?php ?>
    <nav class="navbar navbar-dropdown bg-color transparent navbar-fixed-top">
        <div class="container">
            <div class="mbr-table">
                <div class="mbr-table-cell">
                    <div class="navbar-brand">
                        <a href="index.html" class="navbar-logo"><img src="assets/images/easydelivery-logo-256-128x128-60.png" alt="Easy Delivery" title="Easy Delivery - Transporting made accurate"></a>
                        <a class="navbar-caption text-primary" href="https://mobirise.com">Easy Delivery</a>
                    </div>
                </div>
                <div class="mbr-table-cell">
                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
						<?php if (isset($_SESSION["authenticate"]) && $_SESSION["authenticate"]=='true') { ?>
							<li class="nav-item"><a class="nav-link link" href="driver.php">CREATE DRIVER</a></li>
						<?php } else { ?>
							<li class="nav-item"><a class="nav-link link" href="login.php">LOGIN</a></li>
							<li class="nav-item"><a class="nav-link link" href="register.php">REGISTER</a></li>
						<?php } ?>
						<li class="nav-item"><a class="features.html" href="Features.html">FEATURES</a></li>
						<li class="nav-item"><a class="nav-link link" href="prices.html">PRICES</a></li>
						<li class="nav-item"><a class="nav-link link" href="aboutus.html">ABOUT US</a></li>
						<?php if (isset($_SESSION["authenticate"]) && $_SESSION["authenticate"]=='true') { ?>
							<li class="nav-item"><a class="nav-link link" href="logout.php">LOGOUT</a></li>
						<?php } ?>
						<li class="nav-item nav-btn"><a class="nav-link btn btn-white btn-white-outline" href="download.html">DOWNLOAD</a></li>
					</ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>
