{!! Form::open(['action' => 'SkillsController@store' ]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">上传附件</h4>
</div>
<div class="modal-body">


        <form action="/profiles/avatar/upload" method="POST" class="dropzone" id="myAwesomeDropzone2" style="border: #D9EDF7 1px solid">
            {{ csrf_field() }}
        </form>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    <button type="button" class="btn btn-primary" >确定</button>
</div>
{!! Form::close() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script>
    Dropzone.options.myAwesomeDropzone2 = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 1,
        dictMaxFilesExceeded: '头像只能上传一个',
        dictFallbackMessage: '你的游览器不支持拖拽上传，可以点击下面的上传按钮上传.支持jpg,png,gif格式，大小不要超过2M',
        dictDefaultMessage: '拖拽即可上传！支持jpg,png,gif格式，大小不要超过2M',
        dictFallbackText: '点击upload上传图片',
        dictRemoveFile: true,
        clickable: true
    }

</script>