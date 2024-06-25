<!-- INCLUDE theme_header.tpl -->

<section class="news p-3 my-3">

	<!-- IF ID --><a class="btn btn-info float-right" href="funcs.php?name=news">{_LANG_131}</a><!-- ENDIF -->
	<h4><!-- IF ID --><strong>{TITLE}</strong><!-- ELSE -->{_LANG_132}<!-- ENDIF --></h4>

	<hr />

	<!-- IF ID -->
	<div class="panel panel-default">
		<div class="panel-body">
			<p><strong>{TEXT_INTRO}</strong></p>
			<!-- IF PHOTO --><img class="float-right pl-3 pb-3" src="{PHOTO}" /><!-- ENDIF -->
			<p>{TEXT}</p>
		</div>
	</div>

	<!-- ELSE -->

	<section class="news card-deck row">
		<!-- INCLUDE tpl_news_list.tpl -->
	</section

	<nav class="text-center">
		<ul class="pagination text-center">
			{PAGER}
		</ul>
	</nav>

	<!-- ENDIF -->

</section>

<!-- INCLUDE theme_footer.tpl -->
