<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('adminDashboard')}}" class="brand-link">

        <span class="brand-text font-weight-light">
            <img style=" background-size:100px;border-radius: 5px; " src="https://www.loadserv.com.eg/usersfile/images/brand-logo.png" alt="logo_img"></span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                <li class="nav-item has-treeview  {{($pageTitle =='Customer Page')?'menu-open':''}}" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Customers
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('customers.index')}}" class="nav-link">
                                <i class="far  fa-eye" {{($pageTitle =='Customer Page')?'active':''}}></i>
                                <p>All Customers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('customers.index')}}" class="nav-link {{($pageTitle =='Customer Page')?'active':''}}" disabled>
                                <i class="far fa  fa-plus"></i>
                                <p>New Customer</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{($pageTitle =='Invoices Page')?'menu-open':''}}" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                          Invoices
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('invoices.index')}}" class="nav-link">
                                <i class="far  fa-eye"></i>
                                <p>Show All</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa  fa-plus"></i>
                                <p>Add New Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>




                <li class="nav-item has-treeview {{($pageTitle =='Log Page')?'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-heart"></i>
                        <p>
                            Action Log
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item " >
                            <a href="{{route('logs')}}" class="nav-link {{($pageTitle =='Log Page')?'active':''}}">
                                <i class="far  fa-eye"></i>
                                <p>Show Action</p>
                            </a>
                        </li>


                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
