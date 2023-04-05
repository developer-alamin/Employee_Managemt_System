 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{url('admin/')}}">Employee</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fa fa-bars"></i></button>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{url('admin/')}}">
                        <div class="sb-nav-link-icon"><i class="fa fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading"><h6>Employee Managment</h6></div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                        Employee
                        <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                             <a class="nav-link before" href="{{url('admin/addEmployee')}}">Add Employee</a>
                            <a class="nav-link before" href="{{url('admin/viewemployee')}}">View Employee</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Department
                        <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link before" href="{{url('admin/adddepartment')}}">Add Department</a>
                            <a class="nav-link before" href="{{url('admin/department')}}">View Department</a>
                        </nav>
                    </div>
                    <div class="usersetting"><h6>User Setting</h6></div>
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#userpage" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                        User
                        <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                    </a>
                     <div class="collapse" id="userpage" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link before" href="{{url('admin/logout')}}">Logout</a>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                
            