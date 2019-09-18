<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }

    .styled-checkbox {
        position: absolute;
        opacity: 0;
    }

    .styled-checkbox + label {
        position: relative;
        cursor: pointer;
        padding: 0;
    }

    .styled-checkbox + label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        width: 20px;
        height: 20px;
        background: #eee;
        border: 1px solid #444;
    }

    .styled-checkbox:hover + label:before {
        background: #3f4ab3;
    }

    .styled-checkbox:focus + label:before {
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
    }

    .styled-checkbox:checked + label:before {
        background: #3f4ab3;
    }

    .styled-checkbox:disabled + label {
        color: #b8b8b8;
        cursor: auto;
    }

    .styled-checkbox:disabled + label:before {
        box-shadow: none;
        background: #ddd;
    }

    .styled-checkbox:checked + label:after {
        content: '';
        position: absolute;
        left: 5px;
        top: 9px;
        background: white;
        width: 2px;
        height: 2px;
        box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-6 offset-md-2">
                        <form action="" class="form-inline mb-2">
                            <input type="text" class="form-control text-center bg-white typeahead" name="query"
                                   autocomplete="off"
                                   style="width:65%"
                                   value="<?php echo e(request()->get('query')); ?>"
                                   placeholder="<?php echo e(__('pharmacy.search_place')); ?>"/>
                            <div class="mb-2"></div>
                            <select class="form-control" name="limit">
                                <option value="5" <?php echo e(request()->limit == 5 ? 'selected':''); ?>>5 per page</option>
                                <option value="10" <?php echo e(request()->limit == 10 ? 'selected':''); ?>>10 per page</option>
                                <option value="50" <?php echo e(request()->limit == 50 ? 'selected':''); ?>>50 per page</option>
                                <option value="100" <?php echo e(request()->limit == 100 ? 'selected':''); ?>>100 per page</option>
                                <option value="500" <?php echo e(request()->limit == 500 ? 'selected':''); ?>>500 per page</option>
                                <option value="1000" <?php echo e(request()->limit == 1000 ? 'selected':''); ?>>1000 per page</option>
                            </select>
                            <input type="hidden" name="page" value="<?php echo e(request()->get('page') ?? 1); ?>">
                            <button type="submit" class="btn btn-main   btn-round">
                                <i class="now-ui-icons ui-1_check"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <?php echo e(Form::open([
                        'method'=>'post',
                        'route'=>'handleAdminDeleteAllProduct',
                    ])); ?>


                    <div class="text-left">
                        <span class="text-danger"><?php echo e($errors->first('ids') ?? ''); ?></span>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="styled-checkbox" id="styled-checkbox-0"
                                       onclick="checkAll()">
                                <label for="styled-checkbox-0"></label>
                            </th>
                            <th><?php echo e(__('admin.bar_code')); ?></th>
                            <th><?php echo e(__('admin.product_name')); ?></th>
                            <th><?php echo e(__('admin.product_category')); ?></th>
                            <th><?php echo e(__('admin.origin')); ?></th>
                            <th><?php echo e(__('admin.manufacturer')); ?></th>
                            <th><?php echo e(__('admin.strength')); ?></th>
                            <th><?php echo e(__('store.added_by')); ?></th>
                            <th><?php echo e(__('admin.packet_size')); ?></th>
                            <th width="80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($drugs)==0): ?>
                            <tr>
                                <td colspan="12"><?php echo e(__('admin.no_data')); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="styled-checkbox selected_drugs"
                                           name="selected_drugs[]" id="styled-checkbox-<?php echo e($drug->id); ?>"
                                           value="<?php echo e($drug->id); ?>">
                                    <label for="styled-checkbox-<?php echo e($drug->id); ?>"></label>
                                </td>
                                <td><?php echo e($drug->pharmashare_code); ?></td>
                                <td><?php echo e($drug->trade_name); ?></td>
                                <td><?php echo e($drug->drugCategory->title ?? ''); ?></td>
                                <td><?php echo e($drug->active_ingredient); ?></td>
                                <td><?php echo e($drug->manufacturer); ?></td>
                                <td><?php echo e($drug->strength); ?></td>
                                <td><?php echo e($drug->added_by['firstname'] ?? ''); ?><?php echo e($drug->added_by['lastname'] ?? ''); ?></td>
                                <td><?php echo e($drug->pack_size); ?></td>
                                <td>
                                    <div class="btn-group direction">
                                        <a href="<?php echo e(route('getAdminEditProductView',['id'=>$drug->id])); ?>"
                                           class="btn btn-main p-2 pl-3 pr-3">
                                            <?php echo e(__('settings.update')); ?>

                                        </a>
                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                type="button"
                                                onclick="removeItem('<?php echo e($drug->id); ?>')">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="12" class="text-left">
                                <button type="submit"
                                        class="btn btn-danger"><?php echo e(app()->getLocale() == 'ar' ? 'حذف المحدد':'deleted selected'); ?></button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <?php echo e(Form::close()); ?>


                </div>

                <div class="col-md-12">
                    <?php echo e($drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>