<?php include __DIR__ . "/../navigation/navigation.top.html.php"; ?>

<div class="channel-frame col-xs-12">
	<section class="col-xs-3">
		<h3 class="text-center">User <?= $user->id ?></h3>
	</section>
	<section class="col-xs-6 bg-primary">
		<h1 class="col-xs-8 col-xs-offset-2 text-center">Channel</h1>
		<ul id="messages">
		</ul>
		<div class="form-group" id="textarea">
			<textarea class="form-control"></textarea>
		</div>
	</section>
	<section class="col-xs-3">
		<h3 class="text-center"></h3>
	</section>
	<script>
    
(function ($) {
	
    console.log("Ready for the challenge?");
    var xhr = new XMLHttpRequest;
    xhr.open("GET", "http://localhost/formation-php/web/api/channel?channel=24");
    xhr.onload = ()=>{
     if (200 == xhr.status){
        //transformer du texte en JSON
            window.JSON.parse(xhr.response)
     }
     };
     xhr.send("message={Channel.get("messages")};
     setTimeout(function(){ alert("Hello"); }, 3000);
//      if (13==e.keyCode){
//          this.message(input.value);
//      }

}(window.$));

</script>
</div>

<?php include __DIR__ . "/../sitelinks/sitelinks.bottom.html.php"; ?>