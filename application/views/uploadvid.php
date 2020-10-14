<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Upload Video</title>
    <!-- Dropzone CSS & JS -->
    <link href='<?= base_url() ?>dropzone/dist/dropzone.css' type='text/css' rel='stylesheet'>
    <script src='<?= base_url() ?>dropzone/dist/dropzone.js' type='text/javascript'></script>
    
    <?php $this->load->view('scripts'); ?>
    <script>
      Dropzone.options.myDropzone = {
          autoProcessQueue: true,
          uploadMultiple: true,
          parallelUploads: 10,
          maxFiles: 2,
          processingmultiple() {},
          sending() {},
          totaluploadprogress(uploadProgress) {},
          successmultiple(files, res) {},
          errormultiple(file, res, xhr) {},
          queuecomplete() {}
      };
    </script>
  </head>

  <body>
    <?php $this->load->view('navbar'); ?>

    <div class="container-fluid" style="margin-top:40px">
      <div class="row">

        <?php $this->load->view('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Upload Videos</h1>
          </div>
          <?php echo form_open_multipart('Uploadvid/vid_upload', 'class="dropzone" id="uploadVid"'); ?></form>
          
          <?php echo form_open('Uploadvid/details_upload'); ?>
            <div class="form-group">
              <label for="tile">Title:</label>
              <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group">
              <label for="des">Description:</label>
              <textarea class="form-control" name="des" id="des"></textarea>
            </div>
            <button type="submit" class="btn btn-info">Upload</button>

          </form> 
          <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
        </main>  
  </body>
</html>