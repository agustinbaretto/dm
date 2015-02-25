<div id="ww">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
					<span class="glyphicon glyphicon-bullhorn"></span>
					<h1>About Gustame</h1>
					<p><a href="<?=site_url('main') ?>" target="_blank">Gustame</a> is an app I developed as a project for a Data Mining course I took during fall of 2014.</p>
					<p>Christmas was coming and I wanted to give a book as a gift to a friend and so I faced the problem: what books would this friend like? 
					I had learnt some stuff about recommendation systems so then, I decided to develop an app that could 
					address this problem by making use of information available in social networks about friends interests.</p>
					
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
	
	
	<!-- +++++ Information Section +++++ -->
	
	<div class="container">		
		<div class="row mt">
			<div class="col-lg-12">
				<h4>HOW DOES IT WORK</h4>
				<p>By signing in to the site using their Facebook account, users are able to see a list of their friends and for each of those friends, 
				get recommendations based on the Facebook Pages related to books they already liked. Sounds tricky huh? Then I should not mention that 
				it uses <a href="https://www.freebase.com/" target="_blank">Freebase</a> to disambiguate redundant entities and that it uses a 
				<a href="http://en.wikipedia.org/wiki/Collaborative_filtering" target="_blank">Collaborative Filtering</a> technique based on your 
				closed graph of contacts to do the recommendation… but I will give you an example so you can figure out how it works:</p>
			</div>
		</div><!-- /row -->
		<div class="row mt centered">	
			<div class="col-lg-3">
				<span class="glyphicon glyphicon-user"></span>
				<p>Albert has liked the FB Pages from the books “The Hobbit” and “Alice in Wonderland”.</p>
			</div>
			
			<div class="col-lg-3">
				<span class="glyphicon glyphicon-book"></span>
				<p>Bob and Claire also liked those pages and they also liked “The Narnia Chronicles Book”, which Albert hasn’t.</p>
			</div>

			<div class="col-lg-3">
				<span class="glyphicon glyphicon-heart"></span>
				<p> This means they have similar taste to Albert and that they have read a book Albert might enjoy reading too.</p>
			</div>

			<div class="col-lg-3">
				<span class="glyphicon glyphicon-gift"></span>
				<p>You get a recommendation to give Albert the book “Narnia Chronicles” as a gift.</p>
			</div>
		</div><!-- /row -->
		
		<div class="row mt">
			<div class="col-lg-6">
				<h4>THE NUTS AND CRACKS</h4>
				<p>Here you can download the complete research I made and get a more precise understanding about how this marvelous app works. You can
				also see on the right the slides I usually show when trying to explain my work (my script is missing of course but you can sort of guess it!).</p>
				<div class="centered">
					<a href="<?=site_url('main/download') ?>">
						<img style="width:100px;" src="<?php echo base_url();?>assets/img/pdf-icon.png" alt=""><br/>
						Click to Download!
					</a>
				</div>
			</div><!-- /colg-lg-6 -->
			
			<div class="col-lg-6">
				<h4>THE FANCY VERSION</h4>
				<iframe src="//www.slideshare.net/slideshow/embed_code/43602770" width="476" height="400" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
			</div><!-- /col-lg-6 -->
		</div><!-- /row -->
	</div><!-- /container -->