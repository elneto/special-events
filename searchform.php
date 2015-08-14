<!-- search -->
<form id="site-search" class="search-form form-inline" method="get" action="<?php echo home_url(); ?>" role="search">
	<div class="input-group">
		<label for="search-input" class="sr-only">Search for:</label>
    <input class="search-field form-control" type="search" name="s"  value="<?php if (is_search()) { echo get_search_query(); } ?>" placeholder="Search..." id="search-input">
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default" title="Submit"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>
<!-- /search -->