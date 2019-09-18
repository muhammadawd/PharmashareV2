<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('pages.setting.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">

                                <div class="col-md-12 text-left">
                                    <h3>   <?php echo e(__('store.points')); ?>  </h3>
                                </div>
                                <div class="col-md-12">

                                    <?php echo e(Form::open([
                                        'method'=>'post',
                                        'route'=>'handleCreatePoints'
                                    ])); ?>

                                    <div class="row text-left">
                                        <div class="col-md-12">
                                            <div class="text-left">
                                                <button class="btn btn-main" id="add_button" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <table class="table table-bordered" id="myTable">
                                                <thead>
                                                <tr class="text-left">
                                                    <th></th>
                                                    <th><?php echo e(__('store.points')); ?></th>
                                                    <th></th>
                                                    <th><?php echo e(__('store.purchase_coupon')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>

                                                        <td>
                                                            <button type="button" class="btn btn-danger removerow">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </td>

                                                        <td>
                                                            <input name="points[<?php echo e($k); ?>]" class="form-control text-center"
                                                                   type="number"
                                                                   value="<?php echo e($package->points); ?>">

                                                        </td>

                                                        <td><?php echo e(__('store.replace_by')); ?></td>

                                                        <td>
                                                            <input name="price[<?php echo e($k); ?>]" class="form-control text-center"
                                                                   type="number"
                                                                   value="<?php echo e($package->price); ?>">
                                                        </td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center  m-auto">
                                            <button class="btn btn-main">
                                                <?php echo e(__('settings.update')); ?>

                                            </button>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>