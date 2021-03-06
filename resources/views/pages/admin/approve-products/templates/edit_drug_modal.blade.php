<div class="modal fade" id="edit_drugs_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <form id="edit_form" method="post"> 
                    {{csrf_field()}}
                    <div class="row direction">
                        <input name="id" type="hidden" value="">
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label>{{__('admin.product_category')}}  </label>
                                <input type="typeahead"
                                       autocomplete="off" class="form-control typeahead" name="form"
                                       value="{{old('form')}}">
                            </div>
                            @if($errors->has('form'))
                                <span class="text-danger">{{$errors->first('form')}}</span>
                            @endif
                        </div>
                        <div class="col-md-4 text-left">
                            <div class="form-group">
                                <label>{{__('admin.product_name')}}</label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="trade_name"
                                       value="{{old('trade_name')}}">
                            </div>
                            @if($errors->has('trade_name'))
                                <span class="text-danger">{{$errors->first('trade_name')}}</span>
                            @endif
                        </div>
                        <div class="col-md-4 text-left">
                            <div class="form-group">
                                <label>{{__('admin.bar_code')}} </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="pharmashare_code"
                                       value="{{old('pharmashare_code')}}">
                            </div>
                            @if($errors->has('pharmashare_code'))
                                <span class="text-danger">{{$errors->first('pharmashare_code')}}</span>
                            @endif
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label>  {{__('admin.packet_size')}} </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="pack_size" value="{{old('pack_size')}}">
                            </div>
                            @if($errors->has('pack_size'))
                                <span class="text-danger">{{$errors->first('pack_size')}}</span>
                            @endif
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label>{{__('admin.origin')}}   </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="active_ingredient"
                                       value="{{old('active_ingredient')}}">
                            </div>
                            @if($errors->has('active_ingredient'))
                                <span class="text-danger">{{$errors->first('active_ingredient')}}</span>
                            @endif
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label> {{__('admin.manufacturer')}} </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="manufacturer"
                                       value="{{old('manufacturer')}}">
                            </div>
                            @if($errors->has('manufacturer'))
                                <span class="text-danger">{{$errors->first('manufacturer')}}</span>
                            @endif
                        </div> 
                        <div class="col-md-2 text-left">
                            <div class="form-group">
                                <label>{{__('admin.strength')}} </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="strength" value="{{old('strength')}}">
                            </div>
                            @if($errors->has('strength'))
                                <span class="text-danger">{{$errors->first('strength')}}</span>
                            @endif
                        </div>
    
                        <div class="text-center col-md-12  m-auto">
                            <button class="btn btn-main">
                                {{__('admin.edit')}}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
