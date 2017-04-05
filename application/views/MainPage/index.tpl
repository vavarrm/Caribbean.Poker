<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-12 col-sm-12">
			<div class="row">
				<{for $foo=1 to 10}>
				<div class="col-xs-6 col-lg-3 close position" style="float: left;" status="close">
					<h2 player="" default="Number<{if $foo >3}><{math equation="x + y" x=$foo y=1}><{else}><{$foo}><{/if}>">Number<{if $foo >3}><{math equation="x + y" x=$foo y=1}><{else}><{$foo}><{/if}></h2>
				</div><!--/.col-xs-6.col-lg-4-->
				<{/for}>
				<!--/.col-xs-6.col-lg-4-->
			</div><!--/row-->
		</div><!--/.col-xs-12.col-sm-9-->
	</div><!--/row-->
</div><!--/.container-->
<div id="dialog-form" class="hide" title="Create new player">
	<form  class="form-inline">
		<div class="form-group">
			<select class="form-control" id="market">
				<option value="NA">please select maker</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</div>
		<div class="form-group">
			<input type="text" id="player_name" class="form-control" placeholder="player name input">
		</div>
	</form>
</div>
<script src="/js/mainpage/index.js" rel="stylesheet"></script>