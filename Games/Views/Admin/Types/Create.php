<section class="content-header">
    <h1>Create Game Type</h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href='<?= site_url('admin/games'); ?>'><i class="fa fa-book"></i> Games</a></li>
        <li><a href='<?= site_url('admin/games/types'); ?>'><i class="fa fa-book"></i> Types</a></li>
        <li>Create Game Type</li>
    </ol>
</section>

<section class='content'>

<div class="box box-primary">
    <div class="box-body">

		<form action='<?=site_url('admin/games/types');?>' method='post'>
		<input type='hidden' name='_token' value='<?=csrf_token();?>'>

		<?=Session::getMessages();?>

		<div class="control-group">
		    <label class="control-label" for='title'> Title</label>
		    <input class="form-control" id='title' type="text" name="title" value="<?=Input::old('title');?>" />
		</div>

		<p><br>
		    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i> Submit</button>
		</p>

		</form>

    </div>
</div>


</section>
