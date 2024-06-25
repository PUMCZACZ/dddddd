<!-- INCLUDE theme_header.tpl -->
<div class="row text-center mt-5">
	<div class="col-md-6 col-12 mx-auto bg-white rounded shadow p-5">
		<h2>
			<i class="fas fa-ban float-left mr-2 text-warning" style="font-size:3em;"></i>
			<div>{_LANG_861}</div>
		</h2>
		<p class="text-center">
			<form method="post">
				<div class="row mt-5">
					<div class="col-6 text-center">
						<button type="submit" class="btn btn-default" name="saveAllow" value="1">{_LANG_862}</button>
					</div>
					<div class="col-6 text-center">
						<button type="submit" class="btn btn-success" name="saveAllow" value="2">{_LANG_863}</button>
						<input type="hidden" name="allow" value="{ID}" />
					</div>
				</div>
				<div class="col-12 text-right mt-4">
					<input type="checkbox" name="saveLong" value="1" id="saveLong" /> <label for="saveLong"><span></span> {_LANG_864}</label>
				</div>
			</form>
		</p>
	</div>
</div>
<!-- INCLUDE theme_footer.tpl -->
