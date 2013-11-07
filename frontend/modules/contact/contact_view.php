<h1>Contact</h1>
<?php if(isset($form_ok)) : ?>
   
	<p>
  	Merci ! votre message nous a été transmis par email.
	</p>
	<p>Nous allons vous répondre dans les plus brefs délais.</p>
<?php else : ?>

 	<?php if (isset($error_message)) : ?>
		<p class="alert alert-danger"><?=$error_message?></p>
	<?php else: ?>


    <?php endif; ?>
<div class="row">

    <div class="col-sm-8">
        <form id="contact" method="post" action="" class="form-horizontal well" >
        <div class="form-group">
            <label for="nom"  class="col-sm-3 control-label">Name <sup>*</sup></label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="nom" id="nom" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email <sup>*</sup></label>
            <div class="col-sm-9">
                <input class="form-control" required type="email" name="email" id="email" value="" />
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-3 control-label">Message <sup>*</sup></label>
        	<div class="col-sm-9">
                <textarea required name="message" id="message" class="form-control" rows="5"></textarea>
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" name="contact" value="1" />
            <label for="message" class="col-sm-3 control-label"><small><sup>(*)</sup> Required fields</small></label>
            <div class="col-sm-9">
                <input type="submit" class="btn btn-primary" value="Send" />
             </div>
        </div>
        </form>
    </div>
    <div class="col-sm-4">
    <?=$page['content']?>

    </div>

</div>

<?php endif;  ?>

