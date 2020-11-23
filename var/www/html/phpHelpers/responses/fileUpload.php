<?php

//This file uses resumable.js, jquery and bootstrap to allow chunked uploading of files.




if(!isset($_SESSION['uid'])){header("location: ../../registration/login.php");}
else{$sess=$_SESSION['uid'];}
//the user id is needed in javascript to know where the file should be placed.
//this could potentially allow injection,

?>


<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

<script src="/dependencies/resumable.js" type="application/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<div class="container" style="padding-top: 100px;">

    <div class="row">
        <div class="col-lg-offset-2 col-lg-8">
            <div class="page-header">
                <h1> File Upload<small> <br/></small></h1>
            </div>
        </div>

        <div class="col-lg-offset-2 col-lg-8">
            <button type="button" class="btn btn-success" aria-label="Add file" id="add-file-btn">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Select File
            </button>
            <button type="button" class="btn btn-info" aria-label="Start upload" id="start-upload-btn">
                <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Start upload
            </button>
            <button type="button" class="btn btn-warning" aria-label="Pause upload" id="pause-upload-btn">
                <span class="glyphicon glyphicon-pause " aria-hidden="true"></span> Pause upload
            </button>
        </div>

        <div class="col-lg-offset-2 col-lg-8">
            <p>
            <div class="progress hide" id="upload-progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"   style="width: 0%">
                    <span class="sr-only"></span>
                </div>
            </div>
            </p>
        </div>
    </div>

</div>


<script>
    var tempFileVal = '<?php echo $sess ?>';
    var r = new Resumable({
        target: 'phpHelpers/responses/upload.php',
        testChunks: true,
        query: {id:tempFileVal}
    });

    r.assignBrowse(document.getElementById('add-file-btn'));

    $('#start-upload-btn').click(function(){
        r.upload();
    });

    $('#pause-upload-btn').click(function(){
        if (r.files.length>0) {
            if (r.isUploading()) {
                return  r.pause();
            }
            return r.upload();
        }
    });

    var progressBar = new ProgressBar($('#upload-progress'));

    r.on('fileAdded', function(file, event){
        progressBar.fileAdded();
    });

    r.on('fileSuccess', function(file, message){
        progressBar.finish();
    });

    r.on('progress', function(){
        progressBar.uploading(r.progress()*100);
        $('#pause-upload-btn').find('.glyphicon').removeClass('glyphicon-play').addClass('glyphicon-pause');
    });

    r.on('pause', function(){
        $('#pause-upload-btn').find('.glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play');
    });

    function ProgressBar(ele) {
        this.thisEle = $(ele);

        this.fileAdded = function() {
            (this.thisEle).removeClass('hide').find('.progress-bar').css('width','0%');
        },

            this.uploading = function(progress) {
                (this.thisEle).find('.progress-bar').attr('style', "width:"+progress+'%');
            },

            this.finish = function() {
                (this.thisEle).addClass('hide').find('.progress-bar').css('width','0%');
            }
    }
</script>

</body>
</html>