<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link href="https://innostudio.de/fileuploader/documentation/dist/font/font-fileuploader.css" media="all"
          rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>
    <?php echo e(Html::style('assets/css/jquery.fileuploader.min.css')); ?>

    <?php echo e(Html::style('assets/css/jquery.fileuploader2.min.css')); ?>

    <?php echo e(Html::style('assets/css/jquery.fileuploader-theme-dragdrop.css')); ?>


    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .section {
            padding: 10px 0;
        }
    </style>
    <style>
        .my-group select {
            height: auto !important;
            max-width: 25% !important;
        }

        .my-group .btn-main {
            height: auto !important;
            max-width: 15% !important;
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
        <?php echo $__env->make("pages.profile.edit-store.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.profile.edit-store.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script('assets/js/jquery.fileuploader.min.js')); ?>

    <script>
        $(document).ready(function () {


            table2 = $('#discount_table').DataTable({
                "searching": false,
                "paging": false,
                "autoWidth": false,
                "ordering": false,
                "responsive": false
            });


            table2.on('click', '.removerow', function (e) {
                e.preventDefault();
                let tr = $(this).parent().parent();
                table2.row(tr).remove().draw();
            });

            let counter = <?php echo e(count($drug_store->FOC) ?? 0); ?>;
            $('#add_button').click(function (e) {
                e.preventDefault();
                table2.row.add([
                    `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                    `<input name="foc_quantity[${counter}]" class="form-control text-center" type="number" value="0">`,
                    `<input name="foc_discount[${counter}]" class="form-control text-center" type="number" value="0">`,
                    ``,
                    ``,
                    ``,
                    ``,
                ]).draw(false);
                counter++;
            });

        });
    </script>

    <script>
        $(document).ready(function () {

            // enable fileuploader plugin
            $('input[name="files"]').fileuploader({
                extensions: ['jpg', 'jpeg', 'png'],
                changeInput: '<div class="fileuploader-input">' +
                    '<div class="fileuploader-input-inner">' +
                    '<div class="fileuploader-main-icon"></div>' +
                    '<h3 class="fileuploader-input-caption"><span>${captions.feedback}</span></h3>' +
                    '<p>${captions.or}</p>' +
                    '<div class="fileuploader-input-button"><span>${captions.button}</span></div>' +
                    '</div>' +
                    '</div>',
                theme: 'dragdrop',
                upload: {
                    
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>'
                    },
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: true,
                    synchron: true,
                    beforeSend: null,
                    onSuccess: function (result, item) {

                        var data = {};
                        try {
                            data = result;
                        } catch (e) {
                            data.hasWarnings = true;
                        }


                        // if success
                        if (data.status && data.data[0]) {
                            item.name = data.data[0].name;
                            item.html.find('.column-title > div:first-child').text(data.data[0].name).attr('title', data.data[0].name);
                        }

                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings);
                            }

                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            // go out from success function by calling onError function
                            // in this case we have a animation there
                            // you can also response in PHP with 404
                            return this.onError ? this.onError(item) : null;
                        }

                        item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                        setTimeout(function () {
                            item.html.find('.progress-bar2').fadeOut(400);
                        }, 400);
                    },
                    onError: function (item) {
                        var progressBar = item.html.find('.progress-bar2');

                        if (progressBar.length) {
                            progressBar.find('span').html(0 + "%");
                            progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                            item.html.find('.progress-bar2').fadeOut(400);
                        }

                        item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                            '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                        ) : null;
                    },
                    onProgress: function (data, item) {
                        var progressBar = item.html.find('.progress-bar2');

                        if (progressBar.length > 0) {
                            progressBar.show();
                            progressBar.find('span').html(data.percentage + "%");
                            progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                        }
                    },
                    onComplete: null,
                },
                onRemove: function (item) {
                    
                    
                    
                    
                },
                captions: {
                    feedback: 'قم بالضغط او سحب الملف',
                    feedback2: 'قم بالضغط او سحب الملف',
                    drop: 'رفع ملف الادوية',
                    or: 'او',
                    button: 'تصفح',
                },
                files: []
            });

        });
    </script>
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        <?php if(session()->has('success')): ?>
        $.growl({
            message: `<b> <?php echo e(session()->get('success')); ?> </b>`
        }, {
            type: 'success',
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "right"
            },
            delay: 2500,
            animate: {
                enter: "animated bounceInUp",
                exit: "animated fadeOut"
            },
            offset: {
                x: 30,
                y: 30
            }
        });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>