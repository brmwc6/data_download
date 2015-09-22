$(document).ready(function() {

		$('#wordSubmit').on('submit', function(e) {
			e.preventDefault();

			var old_data = $('#text').val();
			var word = $('#word').val();

			$.ajax({
				type: "POST",
				url: "process.php",
				data: {text: old_data, word: word},
				success: function(data) {
					$('#text').html(data);
				}
			});
		});
	});

	function saveTextAsFile() {
		var textToWrite = document.getElementById("text").value;
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