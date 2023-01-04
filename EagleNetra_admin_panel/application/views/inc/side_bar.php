   <!-- START SIDEBAR -->
   
        <nav class="page-sidebar" id="sidebar" style="position:fixed">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="<?= base_url('./assets/img/admin-avatar.png') ?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?= $this->session->userdata(session_name)?></div>
                        <small>Administrator</small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="<?= $side_bar == 'dashboard'? 'active' : '' ?>" href="<?= base_url()?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a class="<?= $side_bar == 'all_devices'? 'active' : '' ?>" href="<?= base_url('admin/all_devices')?>"><i class="sidebar-item-icon fa fa-archive"></i>
                            <span class="nav-label"> Kids Tracking Device</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?= $side_bar == 'all_users'? 'active' : '' ?>" href="<?= base_url('admin/all_users')?>"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Users</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?= $side_bar == 'subscriptions'? 'active' : '' ?>" href="<?= base_url('admin/subscriptions')?>"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Subscriptions</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?= $side_bar == 'all_kids'? 'active' : '' ?>" href="<?= base_url('admin/all_kids')?>"><i class="sidebar-item-icon fa fa-child"></i>
                            <span class="nav-label">Kids</span>
                        </a>
                    </li>
                    <li>
                        <a href="panic-button-users.html"><i class="sidebar-item-icon fa fa-bell"></i>
                            <span class="nav-label">Panic button Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="geo-fencing.html"><i class="sidebar-item-icon fa fa-map-marker"></i>
                            <span class="nav-label">Geo-Fencing</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR -->