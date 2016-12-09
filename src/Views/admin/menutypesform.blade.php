@extends('Dashboard::dashboard.dashboard')
@section('content-header')

    <!-- Navigation Starts-->
    @include('Dashboard::dashboard.partials.headersidebar')
    <!-- Navigation Ends-->

@stop
@section('content-area')

 <!-- page content -->
        <div class="right_col"  role="main">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{$title}}</h2>
                </div>
            </div>
        </div>
        <?php
        $ThemeHelper = with( new ExtensionsValley\Basetheme\Helpers\ThemeHelper);
        if (isset($menutypes)) {
            $button_text = "Update";
            $action = 'extensionsvalley.admin.updatemenutypes';
        } else {
            $button_text = "Save";
            $action = 'extensionsvalley.admin.savemenutypes';
        }
        if (isset($viewmode)) {
            $readonly = "readonly";
        } else {
            $readonly = "";
        }

        ?>

            {!!Form::open(array('route' => $action, 'method' => 'post'))!!}
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="x_panel">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} control-required">
                        {!! Form::label('title', 'Menu Type Title') !!} <span class="error_red">*</span>
                        {!! Form::text('title', isset($menutypes->title) ? $menutypes->title : \Input::old('title'), [
                            'class'       => 'form-control',
                            'placeholder' => 'Menu Type Title',
                            'required'    => 'required',
                             $readonly
                        ]) !!}
                        <span class="error_red">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('is_all_page') ? 'has-error' : '' }} control-required">
                        {!! Form::label('is_all_page', 'Available on all Pages') !!} <span class="error_red">*</span>
                        {!! Form::select('is_all_page', array('1'=>'Yes','0'=>'No'), isset($menutypes->is_all_page) ? $menutypes->is_all_page :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} control-required">
                        {!! Form::label('status', 'Status') !!} <span class="error_red">*</span>
                        {!! Form::select('status', array('1'=>'Publish','0'=>'Unpublish'), isset($menutypes->status) ? $menutypes->status :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }} control-required">
                        {!! Form::label('position', 'Active Template Position') !!} <span class="error_red">*</span>
                        {!! Form::select('position', $ThemeHelper->getPosition(), isset($menutypes->position) ? $menutypes->position :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
            </div>
            <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <a onclick="history.go(-1);" class="btn btn-success">Cancel</a>
                      @if(!isset($viewmode))
                          {!! Form::submit($button_text, ['class' => 'btn btn-primary']) !!}
                      @endif
                  </div>
            </div>



            @if(isset($menutypes->id))
                <input type="hidden" name="menutypes_id" value="{{$menutypes->id}}"/>
            @endif

            </div>
            </div>





            </div>
             <input type="hidden" name="accesstoken" value="{{\Input::has('accesstoken') ? \Input::get('accesstoken') : ''}}" />


            {!! Form::token() !!}
            {!! Form::close() !!}

    </div>


    <!-- /page content -->
@stop
