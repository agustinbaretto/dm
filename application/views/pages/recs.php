	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
					<div class="friend-photo" style="margin-top: 20px;">
						<img src="https://graph.facebook.com/<?=$ownerId?>/picture?width=150&height=150"/>
					</div>
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Books
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
		      	<ul class="list-group">
							<?php foreach ($books as $name => $info): ?>
							  <li class="list-group-item">
							    <a href="<?=$$info["infoLink"]?>" target="_blank"><?=$name?></a>
							  </li>
							  <li class="list-group-item">
							    <?=$info->description?>
							  </li>
							  <li class="list-group-item">
							    <?=$description?>
							  </li>
							<?php endforeach; ?>
						</ul>
		      </div>
		    </div>
			</div>
		  <!-- div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Movies
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      		<ul class="panel-body">
						<?php foreach ($movies as $name => $ranking): ?>
						  <li class="list-group-item">
						    <!--span class="badge"><?=$ranking?></span-->
						    <?=$name?>
						  </li>
						<?php endforeach; ?>
		      </ul>
		    </div>
		  </div> -->
	  </div>
	</div><!-- /container -->