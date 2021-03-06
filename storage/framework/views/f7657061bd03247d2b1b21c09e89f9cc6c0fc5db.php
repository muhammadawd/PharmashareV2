<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.setting.createPoints.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.setting.createPoints.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/typeahead.bundle.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        table2 = $('#myTable').DataTable({
            "searching": false,
            "paging": false,
            "autoWidth": false,
            "ordering": false,
            "responsive": false
        });
        let counter = <?php echo e(count($packages)); ?>;
        $('#add_button').click(function (e) {
            e.preventDefault();
            table2.row.add([
                `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                `<input name="points[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<?php echo e(__('store.replace_by')); ?>`,
                `<input name="price[${counter}]" class="form-control text-center" type="number" value="0">`,
                ``,
            ]).draw(false);
            counter++;
        });
        table2.on('click', '.removerow', function (e) {
            e.preventDefault();
            let tr = $(this).parent().parent();
            table2.row(tr).remove().draw();
        });
    </script>
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

        });


        <?php if(session()->has('success')): ?>
        globalAddNotify('<?php echo e(session()->get('success')); ?>', 'success');
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
        globalAddNotify('<?php echo e(session()->get('error')); ?>', 'danger');
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>