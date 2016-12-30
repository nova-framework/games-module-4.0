<section class="content-header">
    <h1>Edit Game</h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href='<?= site_url('admin/games'); ?>'><i class="fa fa-book"></i> Games</a></li>
        <li>Edit Game</li>
    </ol>
</section>

<section class='content'>

<div class="box box-primary">
    <div class="box-body">

		<form action='<?=site_url('admin/games/'.$game->id);?>' method='post'>
		<input type='hidden' name='_token' value='<?=csrf_token();?>'>

		<?=Session::getMessages();?>

		<div class='row'>

			<div class='col-md-6'>

				<div class="control-group">
				    <label class="control-label" for='title'> Title</label>
				    <input class="form-control" id='title' type="text" name="title" value="<?=Input::old('title', $game->title);?>" />
				</div>

				<div class="control-group">
				    <label class="control-label" for='type_id'> Type</label>
				    <select name='type_id' id='type_id' class='form-control'>
				    <?php
				    foreach ($types as $type) {
				    	if (Input::old('type_id', $game->type_id) == $type->id) {
				    		$sel = 'selected=selected';
				    	} else {
				    		$sel = null;
				    	}
				    	echo "<option value='$type->id' $sel>$type->title</option>";
				    }
				    ?>
				    </select>
				</div>

			</div>

			<div class='col-md-6'>

				<div class="control-group">
				    <label class="control-label" for='platform_id'> Platform</label>
				    <select name='platform_id' id='platform_id' class='form-control'>
				    <?php
				    foreach ($platforms as $platform) {
				    	if (Input::old('platform_id', $game->platform_id) == $platform->id) {
				    		$sel = 'selected=selected';
				    	} else {
				    		$sel = null;
				    	}
				    	echo "<option value='$platform->id' $sel>$platform->title</option>";
				    }
				    ?>
				    </select>
				</div>

			</div>

		</div>

		<p><br>
		    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i> Submit</button>
		</p>

		</form>

    </div>
</div>

</section>
