</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-light">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Aplikasi Rekap Gudang 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<!-- Datepicker -->
<script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?= base_url(); ?>assets/vendor/gijgo/js/gijgo.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(function() {
        $('.date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }

        $('#tanggal').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf('month')
                ],
                'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
                'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                    .endOf('year')
                ]
            }
        }, cb);

        cb(start, end);
    });

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
            dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            columnDefs: [{
                targets: -1,
                orderable: false,
                searchable: false
            }]
        });

        table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Sparepart",
            allowClear: true
        });
    });
</script>

<script type="text/javascript">
    let hal = '<?= $this->uri->segment(1); ?>';

    let satuan = $('#satuan');
    let supplier = $('#supplier');

    let supplier_aki = $('#supplier_aki');
    let supplier_aki_keluar = $('#supplier_aki_keluar');

    let supplier_ban = $('#supplier_ban');
    let supplier_ban_keluar = $('#supplier_ban_keluar');

    let supplier_oli = $('#supplier_oli');
    let supplier_oli_keluar = $('#supplier_oli_keluar');

    let harga = $('#harga');
    let kondisi = $('#kondisi');
    let stok = $('#stok');
    let ukuran = $('#ukuran');
    let total = $('#total_stok');
    let jumlah = hal == 'barangmasuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');
    let jumlah_aki = hal == 'aki_masuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');
    let jumlah_ban = hal == 'ban_masuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');
    let jumlah_oli = hal == 'oli_masuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');

    $(document).on('change', '#barang_id', function() {
        let url = '<?= base_url('barang/getstok/'); ?>' + this.value;
        $.getJSON(url, function(data) {
            // satuan.html(data.nama_satuan);
            supplier.val(data.nama_supplier);
            stok.val(data.stok);
            harga.val(data.harga);
            total.val(data.stok);
            jumlah.focus();
        });
    });

    $(document).on('change', '#aki_id', function() {
        let url = '<?= base_url('aki/getstok/'); ?>' + this.value;
        $.getJSON(url, function(data) {
            satuan.html(data.nama_satuan);
            supplier_aki.val(data.nama_supplier);
            supplier_aki_keluar.val(data.nama_supplier);
            stok.val(data.stok);
            harga.val(data.harga);
            supplier.val(data.supplier);
            kondisi.val(data.kondisi);
            total.val(data.stok);
            jumlah_aki.focus();
        });
    });

    $(document).on('change', '#ban_id', function() {
        let url = '<?= base_url('ban/getstok/'); ?>' + this.value;
        $.getJSON(url, function(data) {
            satuan.html(data.nama_satuan);
            supplier_ban.val(data.nama_supplier);
            supplier_ban_keluar.val(data.nama_supplier);
            stok.val(data.stok);
            ukuran.val(data.ukuran);
            harga.val(data.harga);
            total.val(data.stok);
            jumlah_aki.focus();
        });
    });

    $(document).on('change', '#oli_id', function() {
        let url = '<?= base_url('oli/getstok/'); ?>' + this.value;
        $.getJSON(url, function(data) {
            satuan.html(data.nama_satuan);
            supplier_oli.val(data.nama_supplier);
            supplier_oli_keluar.val(data.nama_supplier);
            stok.val(data.stok);
            ukuran.val(data.ukuran);
            harga.val(data.harga);
            total.val(data.stok);
            jumlah_aki.focus();
        });
    });

    $(document).on('change', '#id_oli_masuk', function() {
        let url = '<?= base_url('oli/getstokoli/'); ?>' + this.value;
        $.getJSON(url, function(data) {
            satuan.html(data.nama_satuan);
            supplier_oli.val(data.nama_supplier);
            supplier_oli_keluar.val(data.nama_supplier);
            stok.val(data.stok);
            ukuran.val(data.ukuran);
            harga.val(data.harga);
            total.val(data.stok);
            jumlah_aki.focus();
        });
    });

    $(document).on('keyup', '#jumlah_masuk', function() {
        let totalStok = parseInt(stok.val()) + parseInt(this.value);
        total.val(Number(totalStok));
    });

    $(document).on('keyup', '#jumlah_keluar', function() {
        let totalStok = parseInt(stok.val()) - parseInt(this.value);
        total.val(Number(totalStok));
    });
</script>

<?php if ($this->uri->segment(1) == 'dashboard') : ?>
    <!-- Chart -->
    <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                        label: "Total Barang Masuk",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "#5a5c69",
                        pointHoverBorderColor: "#5a5c69",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: <?= json_encode($cbm); ?>,
                    },
                    {
                        label: "Total Barang Keluar",
                        lineTension: 0.3,
                        backgroundColor: "rgba(231, 74, 59, 0.05)",
                        borderColor: "#e74a3b",
                        pointRadius: 3,
                        pointBackgroundColor: "#e74a3b",
                        pointBorderColor: "#e74a3b",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "#5a5c69",
                        pointHoverBorderColor: "#5a5c69",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: <?= json_encode($cbk); ?>,
                    }
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: 5
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

        //laporan
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Barang Masuk", "Barang Keluar"],
                datasets: [{
                    data: [<?= $barang_masuk; ?>, <?= $barang_keluar; ?>],
                    backgroundColor: ['#4e73df', '#e74a3b'],
                    hoverBackgroundColor: ['#5a5c69', '#5a5c69'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
<?php endif; ?>
</body>

</html>