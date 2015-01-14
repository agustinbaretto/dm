	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
					<img src="https://graph.facebook.com/<?=$ownerId?>/picture?width=90&height=90"/>
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
	<ul class="list-group">
	<?php foreach ($recs as $name => $ranking): ?>
	  <li class="list-group-item">
	    <span class="badge"><?=$ranking?></span>
	    <?=$name?>
	  </li>
	<?php endforeach; ?>
	</ul>
	</div><!-- /container -->