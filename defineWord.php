<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<!--<script type="text/javascript" src="http://tinymce.moxiecode.com/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>-->

<script>tinymce.init({selector:'textarea'});</script>

<script type="text/javascript">
	
	$(document).ready(function() {
		$('#wordSubmit').on('submit', function(e) {
			e.preventDefault();

			//var old_data = $('#text').val();
			var old_data = tinyMCE.get('text').getContent();
			var word = $('#word').val();

			$.ajax({
				type: "POST",
				url: "process.php",
				data: {text: old_data, word: word},
				success: function(data) {
					//$('#text').val(data);
					tinyMCE.get('text').setContent(data);
				},
				error: function(j,e) {
					console.error(e);
				}
			});
		});
	});

	function saveTextAsFile() {
		var textToWrite = tinyMCE.get('text').getContent();
		var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
		var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;

		var downloadLink = document.createElement("a");
		downloadLink.download = fileNameToSaveAs;
		downloadLink.innerHTML = "Download File";
		if (window.webkitURL != null)
		{
			// Chrome allows the link to be clicked
			// without actually adding it to the DOM.
			downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
		}
		else
		{
			// Firefox requires the link to be added to the DOM
			// before it can be clicked.
			downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
			downloadLink.onclick = destroyClickedElement;
			downloadLink.style.display = "none";
			document.body.appendChild(downloadLink);
		}

		downloadLink.click();
	}

</script>

<!--<form id="wordSubmit" action="" method="post" onsubmit="return false;">-->
<header>
	<form id="wordSubmit" action="" method="post" onsubmit="return false;">
    <input id="word" class="" size="50" name="word" placeholder="Word to Define" />
	</form>
</header>

<textarea id="text" style="width:100%; height:100%;"></textarea>
<!--</form>-->

<footer>
<!--
	<tr>
		<td><input id="inputFileNameToSaveAs"></input></td>
		<td><button onclick="saveTextAsFile()">Save Text to File</button></td>
	</tr>
-->
</footer>
