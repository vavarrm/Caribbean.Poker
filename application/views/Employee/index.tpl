<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>em_id</th>
				<th>name</th>
				<th>country</th>
				<th>add_datetime</th>
				<th>is_leaving</th>
				<th>leaving_datetime</th>
				<th></th>
			</tr>
			</thead>
			<{foreach from=$table_list item=row}>
				<tr>
					<td><{$row.em_id}></td>
					<td><{$row.em_name}></td>
					<td><{$row.em_country}></td>
					<td><{$row.em_add_datetime}></td>
					<td>
						<{if $row.em_is_leaving ==0}>
						flase
						<{else}>
						true
						<{/if}>
					</td>
					<td><{$row.em_leaving_datetime}></td>
					<td>
						<a type="button" class="btn btn-default" href="add">leaving</a>
					</td>
				</tr>
			<{/foreach}>
		</table>
	</div>
	<div class="col-md-2"></div>
</div>
<div>
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<a type="button" class="btn btn-default" href="add">add</a>
	</div>
	<div class="col-md-2"></div>
</div>