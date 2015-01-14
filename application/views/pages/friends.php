	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
				<div class="friend-photo">
					<img src="https://graph.facebook.com/<?=$owner["id"]?>/picture?width=150&height=150"/>
				</div>
					<h1>Hi <?=$owner["name"]?>, this is Gustame!</h1>
					<p>This tool will allow you to find suggestions of books to give to your friends.</p>
					<a href="<?php echo site_url('matcher/friend/'.$owner["id"]) ?>" class="btn btn-primary btn-lg">See my recommendations</a>
				
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
	<?php $i = 0;?>
	<?php foreach ($friends as $friend): ?>
	<?php if($i%3 == 0):?>
		<div class="row mt centered">
	<?php endif; ?>
			<div class="col-lg-4">
			<div class="friend-photo">
				<a class="zoom green" href="<?php echo site_url('matcher/friend/'.$friend->id) ?>"><img src="https://graph.facebook.com/<?=$friend->id?>/picture?width=150&height=150"/></a>
			</div>
				<p><?=$friend->name?></p>
			</div>
	<?php if($i%3 == 2):?>
		</div><!-- /row -->
	<?php endif; ?>
	<?php $i++;?>
	<?php endforeach; ?>
	</div>
	<!-- /container -->