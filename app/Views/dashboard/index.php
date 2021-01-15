<section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="#">
                <i class="fa fa-dashboard"></i>
                Dashboard
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $kategori; ?></h3>
                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $produk; ?></h3>
                    <p>Total Produk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $pemesanan; ?></h3>
                    <p>Total Pemesanan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-exchange"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $pelanggan; ?></h3>
                    <p>Total Pelanggan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>
    </div>
</section>