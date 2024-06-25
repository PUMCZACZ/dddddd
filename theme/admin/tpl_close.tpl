			</div>
		</td>
	</tr>
</table>
<p class="text-center">
	<small>wszelkie prawa zastrzeżone &copy;</small>
</p>
<script type="text/javascript">
var date = new Date(new Date().valueOf() + {SESSION_ADMIN}*1000);
$('#clock').countdown(date, function(event) {
$(this).html(event.strftime('%M:%S'));
});
</script>
</body>
</html>
