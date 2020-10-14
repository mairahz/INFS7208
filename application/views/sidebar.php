<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column" style="margin-top:10px">
      <?php if($this->session->userdata('logged_in')): ?>
        <li class="nav-item">
          <img src="<?php echo base_url();?>uploads/<?=$userdata['dp']?>" class="img-thumbnail rounded mx-auto d-block" width="100px" height="100px">
        </li>
        
        <li class="nav-item">
          <h4 style="margin-left:40%"><?=$userdata['username']?></h4>
        </li>

        <li class="nav-item list-group-item">
          <a class="nav-link text-info" href="<?php echo base_url();?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
          </a>
        </li>

        <li class="nav-item list-group-item">
          <a class="nav-link text-info" href="<?php echo base_url();?>index.php/Profile/profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
            Profile
          </a>
        </li>
      <?php else: ?>
        <li class="nav-item list-group-item">
          <a class="nav-link text-info" href="<?php echo base_url();?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
          </a>
        </li>
      <?php endif ?>
    </ul>
    <?php if($this->session->userdata('logged_in')): ?>
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Videos</span>

        <a class="d-flex align-items-center text-muted" href="<?php echo base_url();?>index.php/Uploadvid/uploadform" aria-label="Upload a new video">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item list-group-item">
          <a class="nav-link text-info" href="<?php echo base_url();?>index.php/Metube/fav" aria-label="Favourite Videos">
            <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
            </svg>
            Favourite Videos
          </a>
        </li>

        <li class="nav-item list-group-item">
          <a class="nav-link text-info" href="<?php echo base_url();?>index.php/Metube/upvideos" aria-label="Uploaded Videos">
          <svg class="bi bi-upload" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M.5 8a.5.5 0 01.5.5V12a1 1 0 001 1h12a1 1 0 001-1V8.5a.5.5 0 011 0V12a2 2 0 01-2 2H2a2 2 0 01-2-2V8.5A.5.5 0 01.5 8zM5 4.854a.5.5 0 00.707 0L8 2.56l2.293 2.293A.5.5 0 1011 4.146L8.354 1.5a.5.5 0 00-.708 0L5 4.146a.5.5 0 000 .708z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M8 2a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 018 2z" clip-rule="evenodd"/>
          </svg>
            Uploaded Videos
          </a>
        </li>
      </ul>
    <?php endif ?>
  </div>
</nav>