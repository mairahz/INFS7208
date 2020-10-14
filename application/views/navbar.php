<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="margin-bottom:-10px">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">MeTube</a>
  <?php echo form_open('Metube/search', array('method'=>'get', 'class'=>'w-100', 'autocomplete'=>'off', 'id'=>'searchForm'))?>
    <div class="input-group">
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" name="search" id="search" data-toggle="dropdown" >
      <div class="dropdown-menu w-100" id="searchList">  
      </div>
      <div class="input-group-append">
        <button class="btn btn-info" type="submit">
          <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
          </svg>
        </button>
      </div>
    </div>
  </form>
  <ul class="navbar-nav px-3">
    <?php if($this->session->userdata('logged_in')): ?>
      <li class="nav-item text-nowrap">
        <a class="nav-link" href='<?= site_url('Login/logout') ?>'>Sign out</a>
      </li>
    <?php else: ?>
      <li class="nav-item text-nowrap">
        <a class="nav-link" href='<?= site_url('Login/loginForm') ?>'>Sign in</a>
      </li>
    <?php endif ?>
  </ul>
</nav>
<script>
  // Suggest search based on user input
  $('#search').keyup(function() {
    var search = $(this).val();
    var titles = [];
    $('#searchList').empty();
    $.post('<?= site_url('Metube/searchList') ?>', $('#search').serialize(), function (data) {
      $.each(JSON.parse(data), function(index, video){
        titles.push($("<option>").addClass("dropdown-item").text(video.title).val(video.title));
      });
      $('#searchList').append.apply($('#searchList'), titles);
      $('option').click(function(){
        $('#search').val($(this).val());
        $('#searchForm').submit();
      });
    });
  });
</script>