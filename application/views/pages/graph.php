<div id="mynetwork"></div>
<script type="text/javascript">
  // create an array with data
  var data = <?=$data?>;

  // create a network
  var container = document.getElementById('mynetwork');
  var options = {
		  navigation: true,
		  keyboard: true,
		  stabilize: false,
	        configurePhysics:false,
	        clustering:false
      };
  var network = new vis.Network(container, data, options);
  network.on('select', function (properties) {
	  if (properties.nodes[0].indexOf("user") >= 0){
	  	window.location.assign("<?php echo site_url('matcher/friend')?>/"+properties.nodes[0].substring(4))
	  }
	});
</script>