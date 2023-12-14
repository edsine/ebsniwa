{{Form::model($unit,array('route' => array('unit.update', $unit->id), 'method' => 'PUT')) }}
<div class="modal-body">

    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('department_id',__('Department'))}}
                {{Form::select('department_id',$departments,null,array('class'=>'form-control select','placeholder'=>__('select department')))}}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('name',__('Name'))}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Unit Name')))}}
                @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('user_id',__('Unit Head'),['class'=>'form-label'])}}
                {{Form::select('user_id',$users,$head->user_id ?? null,array('class'=>'form-control select','placeholder'=>__('Select Unit Head')))}}
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}
