<li <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home fa-fw"></i> <span>Home</span></a></li>

<?php if ($this->session->userdata('level') == 'Admin') : ?>
    <li <?php echo $this->uri->segment(1) == 'lapangan' || $this->uri->segment(1) == 'jadwal' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('lapangan'); ?>"><i class="fa fa-list fa-fw"></i> <span>Lapangan</span></a></li>
    <li <?php echo $this->uri->segment(1) == 'pemesan' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('pemesan'); ?>"><i class="fa fa-user fa-fw"></i> <span>Pemesan</span></a></li>
    <li <?php echo $this->uri->segment(1) == 'pengguna' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('pengguna'); ?>"><i class="fa fa-users fa-fw"></i> <span>Pengguna</span></a></li>

<?php elseif ($this->session->userdata('level') == 'Pemilik') : ?>
    <li <?php echo $this->uri->segment(1) == 'pemesanan' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('pemesanan'); ?>"><i class="fa fa-money fa-fw"></i> <span>Pemesanan</span></a></li>
    <li <?php echo $this->uri->segment(1) == 'laporan' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('laporan'); ?>"><i class="fa fa-print fa-fw"></i> <span>Laporan Pendapatan</span></a></li>
<?php endif; ?>

<li <?php echo $this->uri->segment(1) == 'password' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('password'); ?>"><i class="fa fa-unlock-alt fa-fw"></i> <span>Ubah Password</span></a></li>
<li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <span>Logout</span></a></li>