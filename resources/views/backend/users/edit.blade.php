@extends($layout)

@section('content')
@php
    $breadcums = ["Member Management", "Users", "Summary", "Edit"];
    $links = [
        ["title" => "Summary", "url" => route($routePrefix . ".index")]
    ];
@endphp

<x-backend.page-header title="User Edit" :breadcums="$breadcums" :links="$links" />

<x-backend.form-errors />


{{ Form::open(['url' => $form['url'] ]) }}
{!! csrf_field() !!}
{{ method_field($form['method']) }}
<div class="row">
    <div class="offset-lg-4 col-lg-4">
        <div class="form-group mb-3">
            <x-inputs.text-field name="name" label="Name" placeholder="Enter Name" value="{{ $model->name }}" />
        </div>
        <div class="form-group mb-3">
            <x-inputs.text-field type="email" name="email" label="Email" placeholder="Enter Email" value="{{ $model->email }}" />
        </div>
        <div class="form-group mb-3">
            <x-inputs.drop-down name="roles[]" label="Roles" class="select2" :list="$role_list" multiple="multiple" value="{{ implode(',', $model->userRole->pluck('role_id')->toArray()) }}" />
        </div>

        <div class="form-group mb-3">            
            <div class="row">
                <div class="col-sm-8">
                    <input type="hidden" id="profile_image" name="profile_image" value="{{ old('profile_image') }}"/>
                    <span id="modal_crop_opener" class="btn btn-secondary">Choose Profile Photo</span>
                </div>
                <div class="col-sm-4">
                    @if($model->profile_image)
                    <a id="profile_photo_block" class="fancybox" data-fancybox="group-{{ $model->id }}" href="{{ FileUtility::get($model->profile_image) }}">
                        <img class="img-thumbnail rounded-circle avatar-xl" src="{{ FileUtility::get($model->profile_image) }}" />
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-buttons">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
</div>
{{ Form::close() }}


<style>
    #crop_image_area{
        width : 100%;
        max-width: 400px;
        height: 400px;
        margin: 0 auto 50px auto;
        border: 1px solid;
        padding: 2px;
    }

    #crop_image_preview{
        display: none;
        margin: 5px auto 5px auto;
        width: 200px;
        height: 200px;
    }
</style>
<div class="modal fade" id="modal-crop" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">            
            <div class="modal-header">
                <h5 class="modal-title">Upload & Crop Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div id="crop_image_area" class="border-primary"></div>                
                
                <input type="file" name="file" id="crop_image_file" class="hidden" />
                <span id="crop_image_file_opener" class="btn btn-secondary">Choose Photo</span>

                <span id="crop_btn" class="btn btn-secondary">Crop</span>
                <div id="crop_image_preview">
                    <img/>
                </div>
            </div>
            <div class="modal-footer">
                <span id="crop_and_upload_btn" class="btn btn-primary">Crop & Upload</span>
                <div id="inline-loader" class="spinner-border text-primary m-1" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $("#modal_crop_opener").click(function(){
            $("#modal-crop").modal("show");
        });

        $("#crop_image_file_opener").click(function(){
            $("input#crop_image_file").click();
        });

        var $uploadCrop = $('#crop_image_area').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            enableExif: true
        });

        function get_file_name()
        {
            var fullPath = $('input#crop_image_file').val();
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }

            return filename;
        }

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        
                    });

                }

                reader.readAsDataURL(input.files[0]);
            } else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $('input#crop_image_file').on('change', function() {
            readFile(this);
        });

        $("#crop_btn").click(function(){
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {                
                $("#crop_image_preview img").attr("src", resp);
                $("#crop_image_preview").show();
                $("#profile_photo_block").hide();
            });
        });

        $("#crop_and_upload_btn").click(function(){
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {                
                $("#crop_image_preview img").attr("src", resp);
                $("#crop_image_preview").show();
                $("#profile_photo_block").hide();

                var url = '/ajax_upload_base64';
                var data = {
                    "base64" : resp, "filename" : get_file_name()
                };

                $("#inline-loader").show();

                $.post(url, data, function(responseText){
                    console.log(responseText);
                    ajaxHandleResponse(url, responseText, function (response) {                        
                        $("#profile_image").val(response['file']);
                        $("#inline-loader").hide();
                        $("#modal-crop").modal("hide");
                    });
                });
            });
        });

    });
</script>
@endsection