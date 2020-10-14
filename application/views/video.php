<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$video['title']?></title>
    <?php $this->load->view('scripts'); ?>
  </head>
  <body>
    <?php $this->load->view('navbar'); ?>

    <div class="container-fluid" style="margin-top:40px">
      <div class="row">
        <?php $this->load->view('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?=$video['title']?></h1>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <video width="1000px" controls><source src="<?php echo base_url();?>uploads/<?=$video['video']?>"></video>
              </div>
            </div>
            <div class="row border-bottom" style="padding-top:40px">
              <div class="col">
                <h4><strong>Uploaded by: <?=$video['username']?></strong></h4> <br>
                <p><?=$video['des']?></p>
              </div>
              <div class="col">
              <h1>
                <?php if($this->session->userdata('logged_in')): ?>
                  <?php if(empty($fav)): ?>
                  <a class="float-right" style="margin-right:150px" href="<?php echo site_url('addFav/'.$videoID);?>">
                    <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z" clip-rule="evenodd"/>
                    </svg>
                  </a>
                  <?php else:?>
                  <a class="float-right" style="margin-right:150px" href="<?php echo site_url('unFav/'.$videoID);?>">
                    <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
                    </svg>
                  </a>
                  <?php endif; ?>
                <?php endif; ?>
              <h2>
              </div>
            </div>
            <div class="row">
              <div class="col border-right">
                <h4 style="margin-top:10px"> Comments</h4>
                <?php echo form_open('Video/add_comment/'.$videoID, "'id'='commentForm'"); ?>
                  <div class="form-group" id="comment">
                    <input type="text" class="form-control" id="commentBox" name="commentBox" placeholder="Add a comment">
                    <div id="commentButtons" style="display: none;">
                      <?php if($this->session->userdata('logged_in')): ?>
                        <div style="margin-left:465px; margin-top:10px; margin-bottom:10px" class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="anon" name="anon" value="1">
                          <label class="custom-control-label" for="anon"> Post Anonymously</label>
                        </div>
                      <?php endif ?>
                      <div style="margin-left:500px" class="btn-group  btn-group-sm" role="group">
                        <button class="btn btn-secondary" id="cancelBtn" type="button">Cancel</button>
                        <button class="btn btn-info" id="submitBtn">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
                <?php if (empty($comments)): ?>
                  <p>There are no comments for this video </p>
                <?php else: ?>
                  <?php foreach ($comments as $comment): ?>
                    <div class="border-bottom" style="padding-bottom:10px">
                      <strong><?= $comment['username']; ?></strong> <br>
                      <?= $comment['comment']; ?>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="col">
                <h4 style="margin-top:10px">Recommended Videos</h4>
                <ul class="list-group list-group-flush" id="videoList">
                  <?php foreach ($videos as $video): ?>
                    <li class="list-group-item">
                      <a class="list-group-item list-group-item-action" href="<?php echo site_url('video/'.$video['videoID']);?>">
                        <div class="row" style="padding:40px">
                          <div class="col">
                            <img src="<?php echo base_url();?>uploads/<?=$video['thumbnail']?>" class="img-rounded" height="200px" width="400px" style="object-fit:contain; background-color:lightgray;">
                          </div>
                          <div class="col">
                            <strong><?=$video['title']?></strong> <br>
                            <?=$video['des']?>
                          </div>
                        </div>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
        </main>  
  </body>
  <script>
    $('#commentBox').focus(function(){
      $("#commentButtons").show();
    });

    $('#cancelBtn').click(function(){
      $('#commentButtons').hide();
    });

    $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        <?php foreach ($videos as $video){ ?>
          $("#videoList").append(
          ' <li class="list-group-item"><a class="list-group-item list-group-item-action" href="<?php echo site_url('video/'.$video['videoID']);?>"><div class="row" style="padding:40px"><div class="col"><img src="<?php echo base_url();?>uploads/<?=$video['thumbnail']?>" class="img-rounded" height="200px" width="400px" style="object-fit:contain; background-color:lightgray;"></div><div class="col"><strong><?=$video['title']?></strong> <br><?=$video['des']?></div></div></a></li>'
          );
        <?php } ?>
      }
    });

  </script>  
</html>