<?php if(is_object($frontpage_photo)) { ?>
	<div style="text-align:center">
		<a href="../photostream/view?photo=<?=$frontpage_photo->id?>"><img border="0" src="<?=$frontpage_photo->getImageURL('small')?>"></a>
	</div>
<?php } ?>
<h2>Welcome to Micro-Flick</h2>
<p>This is a teaching project for Stanford University's Freshman-Sophomore College
Sophomore Fellows program on Web Application Development. This project is originally
written by Chuan Yu Foo and Frank Chen, with additional code from Yifan Mai (templating engine).</p>
<p>This website is a clone of the popular image sharing website, Flickr, albeit with much
reduced functionality. This code is licensed, where applicable, under the MIT License.</p>
