<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.offers.navigators')
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        {{__('store.client_points')}}
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5 text-left">
                                            <label>{{__('store.client_name')}} </label>
                                            <input type="text" class="form-control" value="{{request()->get('pharmacy_name')}}" name="pharmacy_name">
                                        </div>
                                        <div class="col-md-5 text-left">
                                            <label>{{__('store.date')}} </label>
                                            <input type="text" id="datarange" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <button class="btn btn-main" onclick="filterPage()">
                                        {{__('store.filter')}}
                                    </button>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{__('store.client_name')}}  </th>
                                            <th>{{__('store.available_points')}}</th>
                                            <th>{{__('store.last_sale')}}</th>
                                            <th>{{__('store.count_sales')}}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pharmacies as $pharmacy)
                                            <tr>
                                                <td> {{$pharmacy->firstname}} {{$pharmacy->lastname}}</td>
                                                <td> {{$pharmacy->total_points}}</td>
                                                <td> {{$pharmacy->last_sale->created_at ?? ''}}</td>
                                                <td> {{$pharmacy->sales_count ?? ''}}</td>
                                            </tr>
                                        @endforeach
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