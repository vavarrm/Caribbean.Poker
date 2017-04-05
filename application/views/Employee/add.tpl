<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<form class="form-horizontal" method="post" action="doadd">
		<div class="form-group">
			<label class="col-sm-2 control-label">name</label>
			<div class="col-sm-2">
				<input type="input" name="em_name" maxlength="50" class="form-control" required placeholder="name">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">em_country</label>
			<div class="col-sm-2">
				<select name="em_country" class="form-control">
					<option value="kh">Cambodia</option>
					<option value="tw">Taiwan</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">
				<input class="btn btn-default" type="submit" value="Submit">
			</label>
		</div>
	</form>
	</div>
	<div class="col-md-2"></div>
</div>