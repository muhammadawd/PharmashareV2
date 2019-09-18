<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('pages.offers.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <?php echo e(__('store.client_points')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5 text-left">
                                            <label><?php echo e(__('store.client_name')); ?> </label>
                                            <input type="text" class="form-control" value="<?php echo e(request()->get('pharmacy_name')); ?>" name="pharmacy_name">
                                        </div>
                                        <div class="col-md-5 text-left">
                                            <label><?php echo e(__('store.date')); ?> </label>
                                            <input type="text" id="datarange" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <button class="btn btn-main" onclick="filterPage()">
                                        <?php echo e(__('store.filter')); ?>

                                    </button>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('store.client_name')); ?>  </th>
                                            <th><?php echo e(__('store.available_points')); ?></th>
                                            <th><?php echo e(__('store.last_sale')); ?></th>
                                            <th><?php echo e(__('store.count_sales')); ?></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $pharmacies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pharmacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e($pharmacy->firstname); ?> <?php echo e($pharmacy->lastname); ?></td>
                                                <td> <?php echo e($pharmacy->total_points); ?></td>
                                                <td> <?php echo e($pharmacy->last_sale->created_at ?? ''); ?></td>
                                                <td> <?php echo e($pharmacy->sales_count ?? ''); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>