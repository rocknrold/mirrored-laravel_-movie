@extends('layouts.app')

@section('content')
    
    <div class="container">
        <h1>Create producer</h1>
        {!! Form::open(['route' => 'producer.store', 'method' => 'POST']) !!}
        @csrf

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                {!! Form::text('name', old('name'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'name','required'=>'true']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>
            
        <div class="form-group">
            {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
                {!! Form::email('email', old('email'),
                    ['class'=>'form-control '.(old('email')? ($errors->has('email')? 'is-invalid':'is-valid'):''),'id'=>'email','required'=>'true', 'type'=>"email"]) !!}
                @error('website')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('website', 'Website', ['class'=>'control-label']) !!}
                {!! Form::text('website', old('website'),
                    ['class'=>'form-control '.(old('website')? ($errors->has('website')? 'is-invalid':'is-valid'):''),'id'=>'website','required'=>'true']) !!}
                @error('website')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            {!! Form::button('Add producer flms',['class'=>'btn btn-success', 'id'=>'addMore', 'type'=>'button']) !!}
        </div>

        <div class="form-group">
             <table class="table table-sm table-bordered" style="display: none;">
                <tbody id="addRow" class="addRow">
                    {{-- appends --}}
                </tbody>
            </table>
        </div>

            {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
        {!! Form::close() !!}
</div>

 <script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">

        <td>
            {!! Form::select('size', $films, null, ['placeholder' => 'Choose films...','name'=>'prod_films[]', 'class'=>'form-control ']) !!}
        </td>
        <td>
            <i class="fa fa-trash btn btn-danger removeaddmore form-control" aria-hidden="true" style="cursor:pointer;"></i>
        </td>
  </tr>
 </script>

<script type="text/javascript">
 
 $(document).on('click','#addMore',function(){
    
     $('.table').show();

     var prod_films = $("#prod_films").val();
     var source = $("#document-template").html();
     var template = Handlebars.compile(source);

     var data = {
        prod_films: prod_films,
     }

     var html = template(data);
     $("#addRow").append(html)
 });

  $(document).on('click','.removeaddmore',function(event){
    $(this).closest('.delete_add_more_item').remove();
  });                  
</script>

@endsection