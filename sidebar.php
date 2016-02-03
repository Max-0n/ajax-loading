		<div class="openMenu">
			<div class="_layer -top"></div>
			<div class="_layer -mid"></div>
			<div class="_layer -bot"></div>
		</div>
		<div class="menu">
			<ul>
				<li><label>Навигация</label></li>
<?php
	$args=array('orderby' => 'ID','order' => 'ASC');
	$categories=get_categories($args);
	foreach($categories as $category) {
		echo '<li><a href="http://max0n.com/'.mb_strtolower($category->name).'" title="'.$category->description.'" class="control"><div style="padding: 10px 0; background: none;"><label>'.$category->name.'</label></div></a></li>';
	}
?>
			</ul>
			<ul>
				<li><a class="back"><label>Вернуться</label></a></li>
			</ul>
		</div>