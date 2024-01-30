<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <?php $this->load->view("VlogoMenu"); ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel   mb-3 d-flex">

            <div class="info">
                <a href="<?= base_url() ?>" class="d-block"><?= $_SESSION["nama"]; ?> <br>User Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            MASTER DATA
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- PETUGAS HARUS di OWNER -->
                        <!-- <li class="nav-item">
                            <a href="<?= base_url("adm/Cuser") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Tbl Petugas
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?= base_url("adm/Csopir") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Sopir
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url("adm/Cmat") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Material
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("adm/Cpic") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    PIC / Customer
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("adm/Ctujuan") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Tujuan Angkutan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li <li class="nav-item has-treeview">

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            TRANSAKSI
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url("adm/CupdAng") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Update Angkutan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("adm/CpembSpr") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pemb Sopir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("adm/CpembPic") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pemb Cust/PIC
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- =============================================================================== -->


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            LAP Pembayaran
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= base_url("adm/Claporan/pemPerSopir") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pemb. Sopir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("adm/Claporan/pembPerPic") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pemb. PIC/Customer
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- =============================================================================== -->


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            LAP. Angkutan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url("adm/Claporan/perSopir") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ang. Per Sopir
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url("adm/Claporan/perPic") ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ang. Per PIC/Customer
                                </p>
                            </a>
                        </li>



                    </ul>
                </li>





                <li class="nav-header mt-0"></li>
                <li class="nav-item">
                    <a href="<?= base_url("Auth/logout") ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            LOGOUT
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>