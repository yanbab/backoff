<?=$page['content']?>

<div class="row">

	<div class="col-md-6">

		<h2>Subscribe</h2>
		<?php if($state=='subscribe_fail') : ?>
			<p class="alert alert-warning">
			 	Votre email est mal formé, veuillez le corriger : 
			</p>
		<?php endif;?>
		<?php if($state=='subscribe_ok') : ?>
		  	<p class="alert alert-info">
		  		Merci, vous êtes inscrit !
		  	</p>
		<?php else: ?>
			<p>
				<form method="post" class="">
			   		<div class="form-group">
			  			<label for="email">Your email :  </label>
			  			<input type="email" name="email" placeholder="youremail@domain.com" id="email" value=""  class="form-control" />
			  		</div>
			  		<input type="submit" value="Subscribe"  class="btn btn-default">
					<input type="hidden" name="action" value="subscribe">
			  	</form>
			</p>
		<?php endif;?>


		<h2>Unsubscribe</h2>
		<?php if($state!='unsubscribe_ok') : ?>
			<p>
				<form method="post">
		   			<div class="form-group">
		  				<label for="email2">Your email :  </label>
					  	<input type="email" name="email" placeholder="youremail@domain.com" id="email2" value=""  class="form-control" />
						<input type="hidden" name="action" value="unsubscribe">
					</div>
					<input type="submit" value="Unsubscribe" class="btn btn-default">
				</form>
			</p>
		<?php else: ?>
			<p class="alert alert-info">
				You have been sucesfully unsubscribed.
			</p>
		<?php endif;?>

	</div>

	<div class="col-md-6">

		<h2>Archives</h2>
		<?php if(count($lettres)): ?>
			<ul>
			<?php foreach ($lettres as $lettre) : ?>
			  <li><a class="box iframe" href="newsletter/view/<?=$lettre['id'];?>"><?=$lettre['subject'];?></a></li>
			<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p class="alert alert-info">No newsletter yet.</p>
		<?php endif; ?>

	</div>

</div>