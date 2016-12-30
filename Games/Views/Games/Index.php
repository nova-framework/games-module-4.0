<section class='content'>

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
            <button type="reset" class="btn btn-xs btn-warning"><i class="fa fa-refresh"></i> Reset Filter</button>
                </p>

            <p> <?=$games->getTotal();?> Games</p>

        </form>

		<div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered'>
        <tr>
            <th>Title</th>
            <th>Type</th>
        	<th>Platform</th>
        </tr>
        <?php
        if (! $games->isEmpty()) {
        	foreach($games as $row) {
        		echo "<tr>";
                    echo "<td>$row->title</td>";
                    echo "<td>".$row->type->title."</td>";
                    echo "<td>".$row->platform->title."</td>";
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
