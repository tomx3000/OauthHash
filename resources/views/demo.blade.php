<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title> HAsh | Demo</title>

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="assets/vendor/simple-line-icons/css/simple-line-icons.css">
		<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/css/theme.css">
		<link rel="stylesheet" href="assets/css/theme-elements.css">
		<link rel="stylesheet" href="assets/css/theme-blog.css">
		<link rel="stylesheet" href="assets/css/theme-shop.css">
		<link rel="stylesheet" href="assets/css/theme-animate.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/css/custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="/">
										<img alt="Porto" width="100" height="100" data-sticky-width="50" data-sticky-height="50" data-sticky-top="50" src="assets/img/logo.png">
									</a>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<div class="header-search hidden-xs">
										<form id="searchForm" action="page-search-results.html" method="get">
											<div class="input-group">
												<input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
												<span class="input-group-btn">
													<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</form>
									</div>
									<nav class="header-nav-top">
										<ul class="nav nav-pills">


											<li class="hidden-xs">
												<a href="https://hash.zatana.net/login"><i class="fa fa-user"></i><strong>SIGN IN<strong/></a>
											</li>
										</ul>
									</nav>
								</div>
								<div class="header-row">
									<div class="header-nav">
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
											<i class="fa fa-bars"></i>
										</button>
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
											<nav>
												<ul class="nav nav-pills" id="mainNav">
													<li class="hidden-xs active">
														<a  href="/">
															HOME
														</a>

													</li>

													<li class="hidden-xs">
														<a  href="/product">
															Products
														</a>

													</li>

													<!-- <li class="hidden-xs">
														<a  href="page-services.html">
															Services
														</a>

													</li> -->

													<li class="hidden-xs">
														<a  href="/pricing">
															Pricing
														</a>

													</li>

													<li class="hidden-xs">
                                                        <a  href="http://doc.zatana.net">
                                                            Documentation
                                                        </a>

                                                    </li>


													<li class="hidden-xs">
														<a  href="/register">
															SIGN UP
														</a>

													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main shop">

				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<hr class="tall">
						</div>
					</div>

					<div class="row">
						<div class="col-md-9">

							<div class="row">
								<div class="col-md-6">
									<h1 class="mb-none"><strong> Sample Shop</strong></h1>
									<p>Showing 1–2 results.</p>
								</div>
							</div>

							<div class="row">

								<ul class="products product-thumb-info-list" data-plugin-masonry data-plugin-options='{"layoutMode": "fitRows"}'>

									<li class="col-md-4 col-sm-6 col-xs-12 product">
										<a href="#">
											<!-- <span class="onsale">Buy</span> -->
											<form action="/demo" method="post">
												<input type="hidden" name="_token" value="{{ Session::token() }}" />
												<input type="hidden" name="amount" value="85" />
											  <input class="onsale" type="submit" value="Buy">
											</form>   
										</a>
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i>Shop with HAsh</span>
											</a>
											<a href="#">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="assets/img/products/product-2.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="#">
													<h4 class="heading-primary">Nike+</h4>
													<span class="price">
														<span class="amount">$85</span>
													</span>
												</a>
											</span>
										</span>
									</li>
									<li class="col-md-4 col-sm-6 col-xs-12 product">
										<a href="#">
											<!-- <span class="onsale">Buy</span> -->
											<form action="/demo" method="post">
												<input type="hidden" name="_token" value="{{ Session::token() }}" />
												<input type="hidden" name="amount" value="50" />
											  <input class="onsale" type="submit" value="Buy">
											</form>   
										</a>
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i> Shop with HAsh</span>
											</a>
											<a href="#">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="assets/img/products/product-3.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="#">
													<h4 class="heading-primary">Cotton sweater</h4>
													<span class="price">
														<span class="amount">$50</span>
													</span>
												</a>
											</span>
										</span>
									</li>

									</li>

											<span class="product-thumb-info-content">

											</span>
										</span>
									</li>
								</ul>

							</div>

							<div class="row">
								<div class="col-md-12">
									<ul class="pagination pull-right">
										<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<aside class="sidebar">

								<form>
									<div class="input-group input-group-lg">
										<input class="form-control" placeholder="Search..." name="s" id="s" type="text">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>

								<hr>

								<h5 class="heading-primary">Tags</h5>

								<a href="#"><span class="label label-dark">Nike</span></a>
								<a href="#"><span class="label label-dark">Travel</span></a>
								<a href="#"><span class="label label-dark">Sport</span></a>
								<a href="#"><span class="label label-dark">TV</span></a>
								<a href="#"><span class="label label-dark">Books</span></a>
								<a href="#"><span class="label label-dark">Tech</span></a>
								<a href="#"><span class="label label-dark">Adidas</span></a>
								<a href="#"><span class="label label-dark">Promo</span></a>
								<a href="#"><span class="label label-dark">Reading</span></a>
								<a href="#"><span class="label label-dark">Social</span></a>
								<a href="#"><span class="label label-dark">Books</span></a>
								<a href="#"><span class="label label-dark">Tech</span></a>
								<a href="#"><span class="label label-dark">New</span></a>

								<hr>

								<h5 class="heading-primary">Top Rated Products</h5>


									</li>
									<li>
										<div class="post-image">
											<div class="img-thumbnail">
												<a href="#">
													<img alt="" width="60" height="60" class="img-responsive" src="assets/img/products/product-2.jpg">
												</a>
											</div>
										</div>
										<div class="post-info">
											<a href="#">Nike+</a>
											<div class="post-meta">
												$85
											</div>
										</div>
									</li>
									<li>
										<div class="post-image">
											<div class="img-thumbnail">
												<a href="#">
													<img alt="" width="60" height="60" class="img-responsive" src="assets/img/products/product-3.jpg">
												</a>
											</div>
										</div>
										<div class="post-info">
											<a href="#">Cotton Sweater</a>
											<div class="post-meta">
												$50
											</div>
										</div>
									</li>
								</ul>

							</aside>
						</div>
					</div>
				</div>

			</div>

			<footer id="footer">
				<div class="container">
					<div class="row">

						<div class="col-md-3">
							<div class="newsletter">
								<h4>Get Notified</h4>
								<p>Keep up on our always evolving product features and technology.Enter your e-mail and get notified on new wallets intergrated.</p>

								<div class="alert alert-success hidden" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our email list.
								</div>

								<div class="alert alert-danger hidden" id="newsletterError"></div>

								<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
									<div class="input-group">
										<input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							<h4>Developer</h4>
							<div id="tweet" class="twitter" data-plugin-tweets data-plugin-options='{"username": "", "count": 2}'>
								<p><strong>Documentation<strong/></p>
								<p><strong>Payment API<strong/></p>
								<p><strong>Subscription API<strong/></p>
								<p><strong>Button API<strong/></p>
								<p><strong>CONTACT US<strong/></p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Products</h4>
								<ul class="contact">
									<li><p> <strong>About us</strong></p></li>
									<li><p> <strong>Subscription</strong></p></li>
									<li><p> <strong>Payments</strong></p></li>
									<li><p> <strong>Pricing</strong></p></li>
								</ul>
							</div>
						</div>

					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="/" class="logo">
									<img alt="Porto Website Template" class="img-responsive" src="assets/img/logo-footer.png">
								</a>
							</div>
							<div class="col-md-7">
								<p>© Copyright <?php echo date("Y"); ?>. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									<ul>
										<li><a href="page-faq.html">FAQ's</a></li>
										<li><a href="sitemap.html">Sitemap</a></li>
										<li><a href="contact-us.html">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery.appear/jquery.appear.js"></script>
		<script src="assets/vendor/jquery.easing/jquery.easing.js"></script>
		<script src="assets/vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/common/common.js"></script>
		<script src="assets/vendor/jquery.validation/jquery.validation.js"></script>
		<script src="assets/vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="assets/vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="assets/vendor/jquery.lazyload/jquery.lazyload.js"></script>
		<script src="assets/vendor/isotope/jquery.isotope.js"></script>
		<script src="assets/vendor/owl.carousel/owl.carousel.js"></script>
		<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="assets/vendor/vide/vide.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/js/theme.js"></script>

		<!-- Theme Custom -->
		<script src="assets/js/custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="assets/js/theme.init.js"></script>


		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
