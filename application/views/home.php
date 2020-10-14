<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title?></title>
    <?php $this->load->view('scripts'); ?>
    <script type="text/javascript" src="/MeTube/scripts/activity.js"></script>
  </head>

  <?php if($this->session->userdata('logged_in')): ?>
    <body onload="set_interval()";
      onmousemove="reset_interval()";
      onclick="reset_interval()";
      onkeypress="reset_interval()";
      onscroll="reset_interval()";>
  <?php else: ?>
    <body>
  <?php endif;?>

  <?php $this->load->view('navbar'); ?>

  <div class="container-fluid" style="margin-top:40px">
    <div class="row">
      <?php $this->load->view('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?=$heading?></h1>
          </div>

          <div class="container-fluid">
            <ul id="videoList" class="list-group list-group-flush">
              <?php if (empty($videos)): ?>
                <p>There are no videos </p>
              <?php else: ?>
                <?php foreach ($videos as $video): ?>
                  <li class="list-group-item">
                    <a class=" list-group-item-action" href="<?php echo site_url('video/'.$video['videoID']);?>">
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
                    <div style="margin-left:13%">
                      <?php if($title == 'Favourite'): ?>
                        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='<?php echo site_url('Metube/unFavList/'.$video['videoID']);?>';">Unfavourite</button>
                      <?php endif; ?>

                      <?php if($title == 'Uploads'): ?>
                        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='<?php echo site_url('Metube/delete/'.$video['videoID']);?>';">Delete</button>
                      <?php endif; ?>
                    </div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
          <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="2304" height="972" style="display: block; height: 486px; width: 1152px;"></canvas>
        </main>  
        <script>
          // Infinite scrolling
          <?php if ($title == 'Search' || $title == 'Favourite') { } else {?>
          
            $(window).scroll(function() {
              if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                <?php foreach ($videos as $video){ ?>
                  $("#videoList").append(
                  ' <li class="list-group-item"><a class="list-group-item list-group-item-action" href="<?php echo site_url('video/'.$video['videoID']);?>"><div class="row" style="padding:40px"><div class="col"><img src="<?php echo base_url();?>uploads/<?=$video['thumbnail']?>" class="img-rounded" height="200px" width="400px" style="object-fit:contain; background-color:lightgray;"></div><div class="col"><strong><?=$video['title']?></strong> <br><?=$video['des']?></div></div></a></li>'
                  );
                <?php } ?>
              }
            });
          <?php } ?>
        </script>
  </body>
</html>