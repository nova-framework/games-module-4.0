<section class="content-header">
    <h1>Games</h1>
    <ol class="breadcrumb">
        <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Games</li>
    </ol>
</section>

<section class='content'>

<p>
    <a href="<?=site_url('admin/games');?>" class="btn btn-xs btn-warning">Games</a>
    <a href="<?=site_url('admin/games/types');?>" class="btn btn-xs btn-info">Types</a>
    <a href="<?=site_url('admin/games/platforms');?>" class="btn btn-xs btn-info">Platforms</a>
</p>

<div class="box box-primary">
    <div class="box-body">

		<?=Session::getMessages();?>

        <form method="get" class="well">

            <h2>Filter Games:</h2>

            <div class="row">

                <div class='col-md-3'>
                    <div class="control-group">
                        <label class="control-label" for='title'> Game Title</label>
                        <input class="form-control" id='title' type="text" name="title" value="<?=Input::old('title', Input::get('title'));?>" />
                    </div>
                </div>

                <div class='col-md-3'>
                    <div class="control-group">
                        <label class="control-label" for='type_id'> Type</label>
                        <select name='type_id' id='type_id' class='form-control'>
                        <option value=''>Select</option>
                        <?php
                        foreach ($types as $type) {
                            if (Input::old('type_id', Input::get('type_id')) == $type->id) {
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

                <div class='col-md-3'>
                    <div class="control-group">
                        <label class="control-label" for='platform_id'> Platform</label>
                        <select name='platform_id' id='platform_id' class='form-control'>
                        <option value=''>Select</option>
                        <?php
                        foreach ($platforms as $platform) {
                            if (Input::old('platform_id', Input::get('platform_id')) == $platform->id) {
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
            <button type="submit" class="btn btn-xs btn-success" name="submit"><i class="fa fa-check"></i> Filter Games</button>
            <a href="<?=site_url('admin/games');?>" class="btn btn-xs btn-warning"><i class="fa fa-refresh"></i> Reset Filter</a>
                </p>

            <p> <?=$games->getTotal();?> Games</p>

        </form>


		<p><a href='<?=site_url('admin/games/create');?>' class='btn btn-info btn-xs'><i class='fa fa-plus'></i> Create Game</a></p>

		<div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered'>
        <tr>
            <th>Title</th>
            <th>Type</th>
        	<th>Platform</th>
        	<th>Action</th>
        </tr>
        <?php
        if (! $games->isEmpty()) {
        	foreach($games as $row) {
        		echo "<tr>";
                    echo "<td>$row->title</td>";
                    echo "<td>".$row->type->title."</td>";
                    echo "<td>".$row->platform->title."</td>";
        			echo "<td>

        			<a href='".site_url('admin/games/'.$row->id.'/edit')."' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>

        			<a class='btn btn-xs btn-danger' href='#' data-toggle='modal' data-target='#confirm_" .$row->id ."'><i class='fa fa-remove'></i> Delete</a>

        			</td>";
        		echo "</tr>";
        	}
        }
        ?>
        </table>
        </div>

        <p><?=$games->appends([
            'title' => Input::get('title'),
            'type_id' => Input::get('type_id'),
            'platform_id' => Input::get('platform_id')
        ])->links();?></p>

    </div>
</div>

</section>


<?php
if (! $games->isEmpty()) {
    foreach ($games->getItems() as $row) {
?>
<div class="modal modal-default" id="confirm_<?= $row->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Select Game: <?=$row->title;?></h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this game?</p>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary pull-left col-md-3" type="button">Cancel</button>
                <form action="<?= site_url('admin/games/' .$row->id .'/destroy'); ?>" method="POST">
                    <input type="hidden" name="_token" value="<?= csrf_token(); ?>" />
                    <input type="submit" name="button" class="btn btn btn-danger pull-right" value="Delete">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<?php
    }
}
