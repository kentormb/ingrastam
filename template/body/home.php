<!-- <div class="background-image" id="background-image"></div> -->
<form id="form" onsubmit="return false">
	<input id="url_input" type="url" placeholder="www.instagram.com/p/m-i2E5Aj1C..." required />
	<input type="submit" value="Get it!" id="submit" />
</form>
<div class="actions">
	<a href="#" onclick="ga('send', 'event', 'Buttons', 'download', 'Download Image');" id="download" download>Download</a>
	<a href="#" onclick="ga('send', 'event', 'Buttons', 'view', 'Open Image');" id="view" target="_blank">View</a>
	<a href="#" onclick="ga('send', 'event', 'Buttons', 'copy', 'Copy image url');" id="copy" data-clipboard-text="">Copy link</a>
</div>