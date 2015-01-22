	<!-- +++++ Contact Section +++++ -->
	
	<div class="container pt">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 centered">
				<h3>CONTACT ME</h3>
				<hr>
				<p>Feel free to contact me for any matter regarding this site or any other questions or comments.</p>
			</div>
		</div>
		<div class="row mt">	
			<div class="col-lg-8 col-lg-offset-2">
				<form role="form" method="post" accept-charset="utf-8" action="<?= site_url('main/submit_contact') ?>">
				  <div class="form-group">
				    <input type="name" class="form-control" id="NameInputEmail1" name="name" placeholder="Your Name">
				    <br>
				  </div>
				  <div class="form-group">
				    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
				    <br>
				  </div>
				  <textarea class="form-control" rows="6" name="content" placeholder="Enter your text here"></textarea>
				    <br>
				  <button type="submit" class="btn btn-success">SUBMIT</button>
				</form>    			
			</div>
		</div><!-- /row -->
	</div><!-- /container -->