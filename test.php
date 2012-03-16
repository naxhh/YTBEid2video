<?php
/*
 * Just a test case document
 * Run for debug
*/
include('YTBEid2video.php');

$cases = array(
	array( 'url' => '', 'ReturnExpected' => '-1'),
	array( 'url' => 'algo', 'ReturnExpected' => '-1'),
	array( 'url' => '/asd', 'ReturnExpected' => '-1'),
	array( 'url' => 'http://youtube.com',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'http://youtube.com/watch?v=WfQD8x0xsVE',
		   'ReturnExpected' => 'WfQD8x0xsVE'),
	array( 'url' => 'jsU7QU4xLiMasd',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'jsU7QU4xLiM',
		   'ReturnExpected' => 'jsU7QU4xLiM'),
	array( 'url' => 'jsU7QU4xLiMasd',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'http://www.youtube.com/watch?v=WfQD8x0xsVE&feature=autoplay&list=PL43084423ED78178A&lf=mh_lolz&playnext=5',
		   'ReturnExpected' => 'WfQD8x0xsVE'),
	array( 'url' => 'http://www.youtube.com/watch?feature=autoplay&v=WfQD8x0xsVE',
		   'ReturnExpected' => 'WfQD8x0xsVE'),
	array( 'url' => 'http://www.youtube.com',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'http://www.youtu.be/1234',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'http://youtu.be/fSE9SUFnHCo',
		   'ReturnExpected' => 'fSE9SUFnHCo'),
	array( 'url' => 'http://youtu.be/fSE9SUFnHCoASD',
		   'ReturnExpected' => '-1'),
	array( 'url' => 'http://www.youtube.com/embed/qebCk1uGut0',
	   'ReturnExpected' => 'qebCk1uGut0'),
	array( 'url' => 'http://www.youtube.com/embed/qebCk1uGut0ASD',
	   'ReturnExpected' => '-1'),
);
?>

<h2>Test for Parsing URL</h2>
<p>Feel free to add more test cases and give me a feedback</p>
<table>
	<thead>
		<th>id</th>
		<th>Case</th>
		<th>Expects</th>
		<th>Return</th>
	</thead>
	<tbody>
<?php foreach ($cases as $id => $case ){
	$obj = New yt2vid($case['url']);
?>
	<tr style="background-color:<?php echo ($case['ReturnExpected'] == $obj->id) ? 'green' : 'red'; ?>">
		<td><?php echo $id;?></td>
		<td><?php echo $case['url'] ?></td>
		<td><?php echo $case['ReturnExpected'] ?></td>
		<td><?php echo $obj->id; ?></td>
	</tr>

<?php } ?>
	</tbody>
</table>

<h2>Get contents Test</h2>

<?php
	$video = New yt2vid($cases[14]['url']);
?>
<div id="video">
	<h3><?php echo $video->get('title'); ?></h3>
	<img src="<?php echo $video->get('thumb');?>"  style="float:left;"/>
	<p>
		<?php echo $video->get('description');?>
	</p>

</div>
<div style="clear:both;"></div>

<?php
	$video2 = New yt2vid($cases[8]['url']);
?>
<div id="video2">
	<h3><?php echo $video2->get('title'); ?></h3>
	<?php echo $video2->get('embed', Array('width' => 600, 'heigth' => 500)); ?>
</div>