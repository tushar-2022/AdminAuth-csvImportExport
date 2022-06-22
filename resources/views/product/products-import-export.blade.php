@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>
                    <span class = "text-info pull-right"> Upload file format can be downloaded from here.
                            <a href = "javascript:void(0);" id = "excel_file_download" > Download </a>
                    </span>
                  
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('import_parse') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" accept=".csv, text/csv" class="form-control" name="csv_file" required>

                                   <!-- @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif-->
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Import
                                    </button>
                                </div>
                                @if(session('success'))
                                     <div class="alert alert-success" role="alert">
                                         <strong>    {{ session('success') }} </strong>
                                     </div>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Export</div>
                     <span class = "text-info pull-right"> Select appropriate columns to export.
                    </span>
                  
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('export_products') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="0" unchecked> Product Category
                                        </label>
                                    </div>
                                </div>
                            </div>


                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="1" unchecked> Brand Name
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="2" unchecked> Product Name
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="3" unchecked> SKU
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="4" unchecked> Original Price
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="5" unchecked> Recieve Date
                                        </label>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="6" unchecked> Expiry Date
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ids[]" value="7" unchecked> Image Urls
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Export
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
 
$(document).ready(function(){
    $("#excel_file_download").on("click",function(){
        window.location.href = '/download-file';
    });

});   
</script>

@endsection