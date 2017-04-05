<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
		<form class="form-inline">
		<div class="form-group">
			<label for="exampleInputName2">table</label>
			<select class="form-control" name="player numbers">
				<{for $foo=1 to 3}>
				<option value="<{$foo}>"><{$foo}></option>
				<{/for}>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputName2">player numbers</label>
			<select class="form-control"  name="player_numbers">
				<{for $foo=3 to 11}>
				<option value="<{$foo}>" <{if $foo==3}>selected<{/if}> ><{$foo}></option>
				<{/for}>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputName2">position</label>
			<select class="form-control"  name="my_position">
				<{foreach from=$position item=value key=k}>
					<option value="<{$value}>"><{$k}></option>
				<{/foreach}>
			</select>

		</div>
		</form>
	</div>
	<div class="col-md-2">
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-2"></div>	
	<div class="col-md-8">
		<div class="col-sm-2">
			<select name="flopcard1" class="form-control">
				<option value="A">A</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="T">T</option>
				<option value="J">J</option>
				<option value="Q">Q</option>
				<option value="K">K</option>
			</select>
			<select name="flopcardcolor1" class="form-control">
				<option value="s">spades</option>
				<option value="h">hearts</option>
				<option value="d">diamonds</option>
				<option value="c">clubs</option>
			</select>
		</div>
		<div class="col-sm-2">
			<select name="flopcard2" class="form-control">
				<option value="A">A</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="T">T</option>
				<option value="J">J</option>
				<option value="Q">Q</option>
				<option value="K">K</option>
			</select>
			<select name="flopcardcolor2" class="form-control">
				<option value="s">spades</option>
				<option value="h">hearts</option>
				<option value="d">diamonds</option>
				<option value="c">clubs</option>
			</select>
		</div>
		<div class="col-sm-2">
			<select name="flopcard3" class="form-control">
				<option value="A">A</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="T">T</option>
				<option value="J">J</option>
				<option value="Q">Q</option>
				<option value="K">K</option>
			</select>
			<select name="flopcardcolor3" class="form-control">
				<option value="s">spades</option>
				<option value="h">hearts</option>
				<option value="d">diamonds</option>
				<option value="c">clubs</option>
			</select>
		</div>
		<div class="col-sm-1">
			<button class="btn btn-primary" id="flopbtn">flop</button>
		</div>
	</div>	
	<div class="col-md-2"></div>	
</div>
<p>
<div class="row">
	<div class="col-md-2"></div>	
	<div class="col-md-8">
		<div class="col-sm-2">
			<select name="turncard1" class="form-control">
				<option value="A">A</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="T">T</option>
				<option value="J">J</option>
				<option value="Q">Q</option>
				<option value="K">K</option>
			</select>
			<select name="turncardcolor1" class="form-control">
				<option value="s">spades</option>
				<option value="h">hearts</option>
				<option value="d">diamonds</option>
				<option value="c">clubs</option>
			</select>
		</div>
		<div class="col-sm-1">
			<button class="btn btn-primary" id="turnbtn">turn</button>
		</div>
		<div class="col-sm-2">
			<select name="rivercard1" class="form-control">
				<option value="A">A</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="T">T</option>
				<option value="J">J</option>
				<option value="Q">Q</option>
				<option value="K">K</option>
			</select>
			<select name="rivercardcolor1" class="form-control">
				<option value="s">spades</option>
				<option value="h">hearts</option>
				<option value="d">diamonds</option>
				<option value="c">clubs</option>
			</select>
		</div>
		<div class="col-sm-1">
			<button class="btn btn-primary" id="riverbtn">river</button>
		</div>
	</div>
	<div class="col-md-2"></div>	
</div>
<hr>
<div class="row">
	<div class="col-md-2">
	</div>		
	<div class="col-md-8">
		<form class="form-horizontal">
			<{foreach from=$position item=value key=k}>
			<div class="form-group player_action" position="<{$value}>">
				<div class="col-sm-2">
					<label for="exampleInputName2"><{$k}></label>
				</div>
				<div class="col-sm-3">
					<select name="<{$k}>" class="form-control" <{if $value !="SB"}><{/if}> >
						<option value="call">Call</option>
						<option value="bet">Bet</option>
						<option value="raise">Raise</option>
						<option value="fold">Fold</option>
						<option value="allin">All in</option>
					</select>
				</div>
				<div class="col-sm-2">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="text" class="form-control"  name="<{$k}>_value" placeholder="BB" <{if $value !="SB"}><{/if}> >
					</div>
				</div>
				<div class="col-sm-2">
					<div class="input-group">
						<button class="btn btn-primary player_send" position="<{$k}>">send</button>
					</div>
				</div>
			</div>	
			<{/foreach}>
		</form>
	</div>		
	<div class="col-md-2">
	</div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<table class="table table-striped" id="myTable">
			<thead>
				<tr>
					<th>position</th>
					<th>action</th>
					<th>BB</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="col-md-2"></div>
</div>

<script src="/js/mainpage/handCardLog.js" rel="stylesheet"></script>