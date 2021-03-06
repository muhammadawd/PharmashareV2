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
                                   value="{{request()->get('query')}}"
                                   placeholder="{{__('pharmacy.search_place')}}"/>
                            <div class="mb-2"></div>
                            <select class="form-control" name="limit">
                                <option value="5" {{request()->limit == 5 ? 'selected':''}}>5 per page</option>
                                <option value="10" {{request()->limit == 10 ? 'selected':''}}>10 per page</option>
                                <option value="50" {{request()->limit == 50 ? 'selected':''}}>50 per page</option>
                                <option value="100" {{request()->limit == 100 ? 'selected':''}}>100 per page</option>
                                <option value="500" {{request()->limit == 500 ? 'selected':''}}>500 per page</option>
                                <option value="1000" {{request()->limit == 1000 ? 'selected':''}}>1000 per page</option>
                            </select>
                            <input type="hidden" name="page" value="{{request()->get('page') ?? 1}}">
                            <button type="submit" class="btn btn-main   btn-round">
                                <i class="now-ui-icons ui-1_check"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    {{Form::open([
                        'method'=>'post',
                        'route'=>'handleAdminDeleteAllProduct',
                    ])}}

                    <div class="text-left">
                        <span class="text-danger">{{$errors->first('ids') ?? ''}}</span>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="styled-checkbox" id="styled-checkbox-0"
                                       onclick="checkAll()">
                                <label for="styled-checkbox-0"></label>
                            </th>
                            <th>{{__('admin.bar_code')}}</th>
                            <th>{{__('admin.product_name')}}</th>
                            <th>{{__('admin.product_category')}}</th>
                            <th>{{__('admin.origin')}}</th>
                            <th>{{__('admin.manufacturer')}}</th>
                            <th>{{__('admin.strength')}}</th>
                            <th>{{__('store.added_by')}}</th>
                            <th>{{__('admin.packet_size')}}</th>
                            <th width="80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($drugs)==0)
                            <tr>
                                <td colspan="12">{{__('admin.no_data')}}</td>
                            </tr>
                        @endif
                        @foreach($drugs as $drug)
                            <tr>
                                <td>
                                    <input type="checkbox" class="styled-checkbox selected_drugs"
                                           name="selected_drugs[]" id="styled-checkbox-{{$drug->id}}"
                                           value="{{$drug->id}}">
                                    <label for="styled-checkbox-{{$drug->id}}"></label>
                                </td>
                                <td>{{$drug->pharmashare_code}}</td>
                                <td>{{$drug->trade_name}}</td>
                                <td>{{$drug->drugCategory->title ?? ''}}</td>
                                <td>{{$drug->active_ingredient}}</td>
                                <td>{{$drug->manufacturer}}</td>
                                <td>{{$drug->strength}}</td>
                                <td>{{$drug->added_by['firstname'] ?? ''}}{{$drug->added_by['lastname'] ?? ''}}</td>
                                <td>{{$drug->pack_size}}</td>
                                <td>
                                    <div class="btn-group direction">
                                        <a href="{{route('getAdminEditProductView',['id'=>$drug->id])}}"
                                           class="btn btn-main p-2 pl-3 pr-3">
                                            {{__('settings.update')}}
                                        </a>
                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                type="button"
                                                onclick="removeItem('{{$drug->id}}')">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="12" class="text-left">
                                <button type="submit"
                                        class="btn btn-danger">{{app()->getLocale() == 'ar' ? 'حذف المحدد':'deleted selected'}}</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    {{Form::close()}}

                </div>

                <div class="col-md-12">
                    {{$drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>