
	<!-- Brand Logo -->
	<!-- <a href="index3.html" class="brand-link">
		<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</a> -->

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Alexander Pierce</a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<!-- <div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div> -->

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
			<li class="nav-item ">
				<a href="{{url('admin/home')}}" class="nav-link {{ Request::is('admin/home*') ? 'active' : '' }}">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>Dashboard</p>
				</a>
			</li>

			<li class="nav-item @if(Request::is('admin/user/index*') || Request::is('admin/user/create*')) || Request::is('admin/user/edit*')) active menu-open @endif">
				<a href="#" class="nav-link @if(Request::is('admin/user/index*') || Request::is('admin/user/create*')  || Request::is('admin/user/edit*')) active @endif">
					<i class="nav-icon fas fa-user"></i>
					<p>User Management
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>

				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{route('user.create')}}" class="nav-link {{ Request::is('admin/user/create*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Add User</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{route('user.index')}}" class="nav-link {{ Request::is('admin/user/index*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>List User</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item @if(Request::is('admin/product*') || Request::is('admin/product/create*')) active menu-open @endif">
				<a href="#" class="nav-link @if(Request::is('admin/product*') || Request::is('admin/product/create*')) active @endif">
					<i class="nav-icon fas fa-user"></i>
					<p> Product Management
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>

				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{route('product.create')}}" class="nav-link {{ Request::is('admin/product/create*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Add Product</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{route('product.index')}}" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>List Product</p>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item @if(Request::is('admin/category/index*') || Request::is('admin/category/create*')) active menu-open @endif">
				<a href="#" class="nav-link @if(Request::is('admin/category/index*') || Request::is('admin/category/create*')) active @endif">
					<i class="nav-icon fas fa-user"></i>
					<p>
						Category Management
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{route('category.create')}}" class="nav-link {{ Request::is('admin/category/create*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>Add Category</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('category.index')}}" class="nav-link {{ Request::is('admin/category/index*') ? 'active' : '' }}">
							<i class="far fa-circle nav-icon"></i>
							<p>List Category</p>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a href="pages/widgets.html" class="nav-link">
					<i class="nav-icon fas fa-th"></i>
					<p>Order Management
					<!-- <span class="right badge badge-danger">New</span> -->		</p>
				</a>
	        </li>

          	<li class="nav-item">
          		<a href="{{route('feedbackList')}}" class="nav-link">
          			<i class="nav-icon fas fa-th"></i>
          			<p>
          				Feedback Management
          				<!-- <span class="right badge badge-danger">New</span> -->
          			</p>
          		</a>
          	</li>

          	<!-- <li class="nav-header">LABELS</li> -->
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  