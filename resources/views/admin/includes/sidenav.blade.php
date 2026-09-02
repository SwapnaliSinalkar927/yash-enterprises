<div class="hk-menu">
	<!-- Brand -->
	<div class="menu-header">
		<span>
			<a class="navbar-brand" href="index.html">
				{{-- <img class="brand-img img-fluid" src="dist/img/brand-sm.svg" alt="brand" />
				<img class="brand-img img-fluid" src="dist/img/Appster.svg" alt="brand" /> --}}
			</a>
			<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
				<span class="icon">
					<span class="svg-icon fs-5">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left"
							width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
							fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<line x1="10" y1="12" x2="20" y2="12"></line>
							<line x1="10" y1="12" x2="14" y2="16"></line>
							<line x1="10" y1="12" x2="14" y2="8"></line>
							<line x1="4" y1="4" x2="4" y2="20"></line>
						</svg>
					</span>
				</span>
			</button>
		</span>
	</div>
	<!-- /Brand -->

	<!-- Main Menu -->
	<div data-simplebar class="nicescroll-bar">
		<div class="menu-content-wrap">
			<div class="menu-group">
				<ul class="navbar-nav flex-column">
					@can('dashboard_access')
						<li class="nav-item {{ request()->segment(2) == 'home' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.home') }}">
								<span class="nav-icon-wrap">
									<span class="svg-icon">
										<svg xmlns="http://www.w3.org/2000/svg"
											class="icon icon-tabler icon-tabler-template" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<rect x="4" y="4" width="16" height="4" rx="1" />
											<rect x="4" y="12" width="6" height="8" rx="1" />
											<line x1="14" y1="12" x2="20" y2="12" />
											<line x1="14" y1="16" x2="20" y2="16" />
											<line x1="14" y1="20" x2="20" y2="20" />
										</svg>
									</span>
								</span>
								<span class="nav-link-text">Dashboard</span>
								{{-- <span class="badge badge-sm badge-pink ms-auto">Hot</span> --}}
							</a>
						</li>
					@endcan
				</ul>
			</div>

			<div class="menu-group">
				{{-- <div class="nav-header">
					<span>Apps</span>
				</div> --}}
				<ul class="navbar-nav flex-column">
					@can('import_access')
						<li class="nav-item {{ request()->segment(2) == 'imports' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.imports.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-upload-line" style="color:rgba(255, 255, 255, 0.6);"></i></span>
								<span class="nav-link-text">Import</span>
							</a>
						</li>
					@endcan

					@can('export_access')
						<li class="nav-item {{ request()->segment(2) == 'export' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.exports.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-chat-download-fill"></i></span>
								<span class="nav-link-text">Export</span>
							</a>
						</li>
					@endcan

					@can('brand_access')
						<li class="nav-item {{ request()->segment(2) == 'brands' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.brands.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-menu-fill"></i>
								</span>
								<span class="nav-link-text">Brands</span>
							</a>
						</li>
					@endcan
					<!-- @can('latest_code_access')
						<li class="nav-item {{ request()->segment(2) == 'latest-codes' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.latest-codes.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-shopping-cart-2-fill"></i></span>
								<span class="nav-link-text">View Code</span>
							</a>
						</li>
					@endcan -->

					@can('latest_code_access')
						<li
							class="nav-item {{ request()->segment(2) == 'generate-codes' || request()->segment(2) == 'change-code' ? 'active' : '' }}">
							<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse"
								data-bs-target="#codes">
								<span class="nav-icon-wrap">
									<i class="ri-barcode-line"></i>
								</span>
								<span class="nav-link-text">Generate Code</span>
							</a>
							<ul id="codes" class="nav flex-column collapse  nav-children">
								<li class="nav-item">
									<ul class="nav flex-column">
										@can('code_create')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.latest-codes.create') }}"><span
														class="nav-link-text">Generate Code</span></a>
											</li>
										@endcan

										@can('latest_code_access')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.latest-codes.index') }}"><span
														class="nav-link-text">View Code</span></a>
											</li>
										@endcan

										<!-- @can('code_change_access')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.change_code') }}"><span
														class="nav-link-text">Change Code</span></a>
											</li>
										@endcan -->
									</ul>
								</li>
							</ul>
						</li>
					@endcan

					@can('latest_wholesaler_access')
						<li class="nav-item {{ request()->segment(2) == 'latest-wholesalers' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.latest-wholesalers.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-shopping-cart-2-fill"></i></span>
								<span class="nav-link-text">View Wholesalers</span>
							</a>
						</li>
					@endcan

					@can('latest_order_access')
						<li class="nav-item {{ request()->segment(2) == 'latest-orders' ? 'active' : '' }}">
							<a class="nav-link" href="{{ route('admin.latest-orders.index') }}">
								<span class="nav-icon-wrap">
									<i class="ri-shopping-cart-2-fill"></i></span>
								<span class="nav-link-text">View Orders</span>
							</a>
						</li>
					@endcan

					@can('user_management_access')
						<li
							class="nav-item {{ request()->segment(2) == 'users' || request()->segment(2) == 'roles' || request()->segment(2) == 'permissions' ? 'active' : '' }}">
							<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse"
								data-bs-target="#dash_contact">
								<span class="nav-icon-wrap">
									<i class="ri-file-user-fill"></i>
								</span>
								<span class="nav-link-text">User Management</span>
							</a>
							<ul id="dash_contact" class="nav flex-column collapse  nav-children">
								<li class="nav-item">
									<ul class="nav flex-column">
										@can('permission_access')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.permissions.index') }}"><span
														class="nav-link-text">Permissions</span></a>
											</li>
										@endcan

										@can('role_access')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.roles.index') }}"><span
														class="nav-link-text">Roles</span></a>
											</li>
										@endcan

										@can('user_access')
											<li class="nav-item">
												<a class="nav-link" href="{{ route('admin.users.index') }}"><span
														class="nav-link-text">Admin Users</span></a>
											</li>
										@endcan
									</ul>
								</li>
							</ul>
						</li>
					@endcan
				</ul>
			</div>

			<div class="menu-gap"></div>

			@can('misc_access')
				<div class="menu-group">
					<div class="nav-header">
						<span>MISCELLANEOUS</span>
					</div>
					<ul class="navbar-nav flex-column">
						@can('wd_access')
							<li class="nav-item {{ request()->segment(2) == 'wds' ? 'active' : '' }}">
								<a class="nav-link" href="{{ route('admin.wds.index') }}">
									<span class="nav-icon-wrap">
										<i class="ri-menu-fill"></i>
									</span>
									<span class="nav-link-text">WDs</span>
								</a>
							</li>
						@endcan

						@can('login_history_access')
							<li class="nav-item {{ request()->segment(2) == 'login-histories' ? 'active' : '' }}">
								<a class="nav-link" href="{{ route('admin.login_history') }}">
									<span class="nav-icon-wrap">
										<i class="ri-file-history-line"></i>
									</span>
									<span class="nav-link-text">Login History</span>
								</a>
							</li>
						@endcan
					</ul>
				</div>
			@endcan

		</div>
	</div>
	<!-- /Main Menu -->
</div>
<div id="hk_menu_backdrop" class="hk-menu-backdrop"></div>