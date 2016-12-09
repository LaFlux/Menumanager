 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} control-required">
                    {!! Form::label('menu_type', 'Menu Type') !!}<span class="mand_star"> *</span>
                     {!! Form::select("module_params[menu_type]", ExtensionsValley\Menumanager\Models\Menutypes::getMenuTypes(), null, [
                        'class'       => 'form-control',
                    ]) !!}
                    <span class="error_span">{{ $errors->first('menu_type') }}</span>
                </div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('module_layout') ? 'has-error' : '' }} control-required">
                    {!! Form::label('module_layout', 'Module layout') !!}
                    {!! Form::text('module_layout', 'Menumanager::front.menus', [
                        'class'       => 'form-control',
                        'placeholder' => 'Module Layout',
                        'required'    => 'required',
                        'readOnly' =>'readOnly'
                    ]) !!}
                    <span class="error_span">{{ $errors->first('module_layout') }}</span>
                </div>
</div>
<input type="hidden" name="foreign_key" value="menu_type" />
