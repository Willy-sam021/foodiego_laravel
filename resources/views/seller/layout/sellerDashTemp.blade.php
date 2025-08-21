<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>@yield('title','seller dashboard')</title>

	<link href="{{asset('User_dashboard/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('/assets/css/sellerDash.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/sellerDash.css')}}">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
                    <span class="align-middle">{{auth()->user()->name}}</span>
                 </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="index.html">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.html">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                        </a>
					</li>

					<li class="sidebar-item">
                        <form action="{{route('logout')}}" method="post" class="">
                            @csrf

                            <button type="submit" class="sidebar-link ms-4" style="background: none; border: none; padding: 0; align-text: center">
                                <i class="align-middle" data-feather="log-out"></i>
                                <span class="align-middle">Logout</span>
                            </button>

                        </form>

					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
                        </a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="pages-blank.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
					</li>

					<li class="sidebar-header">
						Other Actions
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('product.create')}}">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Add New Product</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('seller.orders')}}">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">View all Orders</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <a href="{{route('homePage')}}">Home</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						{{-- <li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li> --}}
						<li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-gear"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="pages-profile.html">
                                    <i class="align-middle me-1" data-feather="user"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="align-middle me-1" data-feather="pie-chart"></i> Analytics
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html">
                                    <i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="align-middle me-1" data-feather="help-circle"></i> Help Center
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">Log out</a>
                            </div>
                        </li>
					</ul>
				</div>
			</nav>


            @yield('content')





            {{-- <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer> --}}
		</div>
	</div>

<script src="{{asset('User_dashboard/js/app.js')}}"></script>
@yield('javascript')
</body>

</html>
