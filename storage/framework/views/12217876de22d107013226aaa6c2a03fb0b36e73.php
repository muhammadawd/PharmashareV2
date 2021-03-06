<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>

    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <?php echo e(Html::style('assets/css/multiple-select.css')); ?>

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
            min-width: 15% !important;
        }

        .form-check {
            margin-top: -17px;
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
        <?php echo $__env->make("pages.admin.users.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.users.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.users.templates.select_show_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.users.templates.showinfo_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.users.templates.showLicense_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("assets/js/multiple-select.js")); ?>

    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $('#dataTable1').DataTable({
                "searching": true,
                "paging": true,
                "autoWidth": false,
                "ordering": false,
            });
            $('#dataTable2').DataTable({
                "searching": true,
                "paging": true,
                "autoWidth": false,
                "ordering": false,
            });
        });

    </script>
    <script>
        function remove_account(id) {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText:  '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                console.log(result);
                if (result) {
                    $.ajax({
                        method: 'delete',
                        url: '<?php echo e(route('RemoveAccount')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id
                        },
                        success: function (response) {
                            console.log(response)
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }

        function activate_account(id) {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText:  '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo e(route('activateAccount')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id
                        },
                        success: function (response) {
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }
        
        function deactivate_account(id) {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                html: `<h4><?php echo e(__('settings.are_you_sure')); ?></h4>
                    <input class="form-control" name="message" placeholder="message Ar"/>
                    <input class="form-control" name="message_en" placeholder="message En"/>
                `,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText:  '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo e(route('deactivateUser')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            message: $('input[name="message"]').val(),
                            message_en: $('input[name="message_en"]').val(),
                        },
                        success: function (response) {
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }
        
        
    </script>

    <script>
        $("#showLicense_modal").on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let trade_license_path = button.data('trade_license_path');
            let passport_license_path = button.data('passport_license_path');
            let pharmacy_license_path = button.data('pharmacy_license_path');
            let role_id = button.data('role_id');
            let user = button.data('user');
            console.log(trade_license_path)

            $('#license_images').empty();
            $('#_fullname').text(user.firstname + ' ' + user.lastname);
            $('#_phone').text(user.prefix + user.phone);
            $('#_permission').text(user.role.title);
            $('#_username').text(user.username);
            $('#_email').text(user.email);
            $('#_full_address').text(user.full_address);
            if(role_id != 4){
                
                if (!trade_license_path) {
                    $('#license_images').append(`
                        <div class="col-md-4 text-center">
                            <img src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                        </div> 
                    `);
                } else {
                    $('#license_images').append(`
                            <div class="col-md-4 text-left">
                                <h4>
                                    <a class="text-dark text-black" href="${trade_license_path}">
                                        <i class="now-ui-icons arrows-1_cloud-download-93"></i> download
                                    </a>
                                </h4>
                                <img src="${trade_license_path}" alt="">
                            </div>
                        `);
     
                }
                
                if (!passport_license_path) {
                    $('#license_images').append(`
                        <div class="col-md-4 text-center">
                            <img src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                        </div> 
                    `);
                } else { 
                    $('#license_images').append(`
                            <div class="col-md-4 text-left">
                                <h4>
                                    <a class="text-dark text-black" href="${passport_license_path}">
                                        <i class="now-ui-icons arrows-1_cloud-download-93"></i> download
                                    </a>
                                </h4>
                                <img src="${passport_license_path}" alt="">
                            </div>
                        `); 
                }
           
            }
            
            if (!pharmacy_license_path) {
                $('#license_images').append(`
                    <div class="col-md-4 text-center">
                        <img src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                    </div> 
                `);
            } else { 
                $('#license_images').append(`
                        <div class="col-md-4 text-left">
                            <h4>
                                <a class="text-dark text-black" href="${pharmacy_license_path}">
                                    <i class="now-ui-icons arrows-1_cloud-download-93"></i> download
                                </a>
                            </h4>
                            <img src="${pharmacy_license_path}" alt="">
                        </div>
                    `);
            }
        });

        $("#showrating_modal").on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let user_id = button.data('user-id');

            $.ajax({
                method: 'get',
                url: '<?php echo e(route('getStoreRates')); ?>',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    store_id: user_id
                },
                success: function (response) {
                    if (response.status) {
                        $('#table_body').empty();
                        $.each(response.data.response.ratings, function (index, item) {
                            console.log(item)
                            $('#table_body').append(`
                                <tr>
                                    <td>

                                    <div class="media">
                                        <a class="float-left" href="#">
                                            <div class="avatar">
                                                <img class="media-object img-raised" style="width: 50px;height:50px;border-radius:50%"
                                                     src="${item.pharmacy.image_path ? item.pharmacy.image_path : '<?php echo e(asset("assets/img/user_avatar.jpg")); ?>'} "
                                                     alt="...">
                                            </div>
                                        </a>
                                        <div class="media-body" style="padding:8px">
                                            <h6 class="media-heading text-left mb-0 text-capitalize"> ${item.pharmacy.firstname + ' ' + item.pharmacy.lastname}</h6>
                                            <small style="font-size: 10px;" class="text-muted">${item.comment}</small>
                                        </div>
                                    </div>

                                    </td>
                                </tr>
                            `);
                        })
                    }
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>