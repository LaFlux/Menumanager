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
        if (isset($menuitems)) {
            $button_text = "Update";
            $action = 'extensionsvalley.admin.updatemenuitems';
            $current_menu_id = $menuitems->id;
        } else {
            $button_text = "Save";
            $action = 'extensionsvalley.admin.savemenuitems';
            $current_menu_id = 0;
        }
        if (isset($viewmode)) {
            $readonly = "readonly";
        } else {
            $readonly = "";
        }

        ?>

            {!!Form::open(array('route' => $action, 'method' => 'post'))!!}
            <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <div class="x_panel">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('menu_name') ? 'has-error' : '' }} control-required">
                        {!! Form::label('title', 'Menu Item Name') !!} <span class="error_red">*</span>
                        {!! Form::text('menu_name', isset($menuitems->menu_name) ? $menuitems->menu_name : \Input::old('menu_name'), [
                            'class'       => 'form-control',
                            'placeholder' => 'Menu Item Name',
                            'required'    => 'required',
                             $readonly
                        ]) !!}
                        <span class="error_red">{{ $errors->first('menu_name') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('source') ? 'has-error' : '' }} control-required">
                        {!! Form::label('source', 'Source ') !!} <span class="error_red">*</span>
                         {!! Form::text('source', isset($menuitems->source) ? $menuitems->source : \Input::old('source'), [
                            'class'       => 'form-control menusource',
                            'placeholder' => 'Source can be external or internal url ',
                            'required'    => 'required',
                             $readonly
                        ]) !!}
                    </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('menu_type') ? 'has-error' : '' }} control-required">
                        {!! Form::label('menu_type', 'Menu Type') !!} <span class="error_red">*</span>
                        {!! Form::select('menu_type',ExtensionsValley\Menumanager\Models\Menutypes::getMenuTypes() , isset($menuitems->menu_type) ? $menuitems->menu_type :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }} control-required">
                        {!! Form::label('parent_menu', 'Parent Menu') !!} <span class="error_red">*</span>
                        {!! Form::select('parent_menu', array('0' => 'Root Level Menu') + ExtensionsValley\Menumanager\Models\Menuitems::getParentMenus($current_menu_id)->toArray(), isset($menuitems->parent_menu) ? $menuitems->parent_menu :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
            </div>
             <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('is_new_tab') ? 'has-error' : '' }} control-required">
                        {!! Form::label('tab_mode', 'Open as New Tab') !!} <span class="error_red">*</span>
                        {!! Form::select('is_new_tab', array('0'=>'No','1'=>'Yes'), isset($menuitems->is_new_tab) ? $menuitems->is_new_tab :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('is_spa') ? 'has-error' : '' }} control-required">
                        {!! Form::label('is_spa', 'Single Page Menu') !!} <span class="error_red">*</span>
                        {!! Form::select('is_spa', array('0'=>'No','1'=>'Yes'), isset($menuitems->is_spa) ? $menuitems->is_spa :null, [
                            'class'       => 'form-control select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>
                  </div>
            </div>
            <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('ordering') ? 'has-error' : '' }} control-required">
                        {!! Form::label('ordering', 'Menu Ordering') !!} <span class="error_red">*</span>
                        {!! Form::number('ordering', isset($menuitems->ordering) ? $menuitems->ordering : \Input::old('ordering'), [
                            'class'       => 'form-control',
                            'placeholder' => 'Menu item ordering numeric value',
                            'required'    => 'required',
                             $readonly
                        ]) !!}
                    </div>
                  </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} control-required">
                        {!! Form::label('status', 'Status') !!} <span class="error_red">*</span>
                        {!! Form::select('status', array('1'=>'Publish','0'=>'Unpublish'), isset($menuitems->status) ? $menuitems->status :null, [
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



            @if(isset($menuitems->id))
                <input type="hidden" name="menuitems_id" value="{{$menuitems->id}}"/>
            @endif

            </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
              <div class="x_panel">
                <div class="x_title">
                          <h2>Menu Source</h2>
                          <ul class="nav navbar-right panel_toolbox">
                              <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                          </ul>
                          <div class="clearfix"></div>
                </div>
                  <div class="x_content">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group {{ $errors->has('layout') ? 'has-error' : '' }} control-required">
                        {!! Form::label('pages', 'Pages') !!} <span class="error_red">*</span>
                        {!! Form::select('pages', array('0' => 'select any page')+ ExtensionsValley\Pages\Models\Pages::getPageswithSlug()->toArray(), null, [
                            'class'       => 'form-control select2 buildpageurl',
                            'required'    => 'required'
                            ,'data-target' => 'menusource'
                        ]) !!}
                    </div>
                  </div>

                  </div>
              </div>
              </div>



            </div>
             <input type="hidden" name="accesstoken" value="{{\Input::has('accesstoken') ? \Input::get('accesstoken') : ''}}" />


            {!! Form::token() !!}
            {!! Form::close() !!}

    </div>


    <!-- /page content -->
@stop
