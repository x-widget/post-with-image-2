<?
	widget_css();
	widget_javascript();

	for ( $forum_ctr = 1; $forum_ctr <=9; $forum_ctr++ ) {
		$menu = $widget_config['forum'.$forum_ctr];
		if ( empty($menu) ) continue;
		$menu_name = $widget_config['post-with-image-2-menu-name'.$forum_ctr];
		if ( empty($menu_name) ) $menu_name = $menu;
		$posts_image_2[] = array( 'url' => $menu, 'name' => $menu_name  );
	} 
	if ( empty($posts_image_2) ) $posts_image_2[] = array( 'url' => bo_table(1) , 'name'	=> 'forum 1' );
	$height = 360;
	$width = 170;
	
?>
<div class='post-with-image-2-title'><?=$widget_config['title']?></div>
<div class='post-with-image-2-container'>

<?	
	$i = 0;			
	?>
	<div class='image2-menu-wrapper'>
	
		<div class='image-2-previous'><img src="<?=x::theme_url('img/image2_left_arrow.png')?>"/></div>
	
		<div class='image-2-menu'><?
			foreach ( $posts_image_2 as $menu ) { ?> 
				<span class='image2-menu-name <? if ( $i++ == 0 ) echo "selected first-menu"?>' menu2_name="<?=$menu['url']?>">
					<span class='inner'>
						<img src="<?=x::theme_url('img/category_'.$i.'.png')?>" class='not-active-background'/>
						<img src="<?=x::theme_url('img/category_'.$i.'b.png')?>" class='active-background'/>
						<div class='menu2_name'><?=$menu['name']?></div>
					</span>
				</span> <? } ?>
			<div style='clear: left'></div>
		</div>
		
		<div class='image-2-next'><img src="<?=x::theme_url('img/image2_right_arrow.png')?>"/></div>
		<div style='clear: left'></div>
		
	</div>
	<? $i = 0;
	foreach ( $posts_image_2 as $forum ) {
		$list = db::rows("SELECT * FROM $g5[write_prefix]$forum[url] WHERE wr_is_comment = 0 ORDER BY wr_num LIMIT 0, 10 ");
		$bo_subject = db::result("SELECT bo_subject FROM $g5[board_table] WHERE bo_table='$forum[url]'");
		/** Temporarily used direct query instead of g::posts,
			because this widget requires the non-stripped
			wr_content to make use of g::thumbnail_from_image_tag
			$list= g::posts( array('limit' => 10, 'select' => 'wr_content, wr_id, wr_subject', 'bo_table' => $forum['url']) );
		*/
	?>
	<div class='post-with-image-2 <?=$forum['url']?> <? if ( $i++ == 0 ) echo "selected"?>'>
	<div class='gallery_with_image_2'>
	
	<?
	if ( $list ) {
	$post_number = 1;
	foreach ( $list as $post ) {
		$imgsrc = get_list_thumbnail($forum['url'], $post['wr_id'], $width, $height);
		if ( $imgsrc['src'] ) {
			$img = $imgsrc['src'];
		} elseif ( $image_from_tag = g::thumbnail_from_image_tag( $post['wr_content'], $forum['url'], $width, $height )) {
			$img = $image_from_tag;
		} else $img = g::thumbnail_from_image_tag("<img src='".x::url()."/widget/$widget_config[name]/no-image.png'/>", $forum['url'], $width, $height);
		?>
		<div class='gallery4-with-image-2 post_<?=$post_number++?>'>
			<? if ( $post ) {
					$url = g::url()."/bbs/board.php?bo_table=$forum[url]&wr_id=$post[wr_id]";
					$subject = cut_str($post['wr_subject'],15,'');
					$content = cut_str(strip_tags($post['wr_content']), 100,'');
			}
			else {
				$url = "javascript:void(0);";
				$subject = "회원님께서는 현재";
				$content = "필고 갤러리 테마 No.3를 선택 하셨습니다.";
			}
			?>
			<div class='inner'>
				<div class='post-image'><a href="<?=$url?>" ><img src="<?=$img?>"/></a></div>
				<div class='subject-wrapper'><div class='subject'><a href="<?=$url?>" ><?=$subject?></a></div></div>
				<div class='content-wrapper'><div class='content'><a href="<?=$url?>" ><?=$content?></a></div></div>
			</div>
			<a href='<?=$url?>' class='read_more'></a>
		</div>

	<?
	} 
		echo "<div style='clear: left'></div>";
		if ( count ( $list ) > 5 )	echo "<div class='post-with-image-more' post_category='$forum[url]'>MORE v</div>";
		else echo "<div class='post-with-image-more'><a href='bbs/board.php?bo_table=$forum[url]'>view more</a></div>";
		
	} else {
		echo "
				<div class='no_post'>
					<img src='".x::url()."/widget/$widget_config[name]/no_image_banner.png' />
				</div>
			";
	}	
	?>
	
		</div>
		<?if ( preg_match('/msie 7/i', $_SERVER['HTTP_USER_AGENT'] ) ) {?>
		<style>
			.bottom-left img, .bottom-middle img, .bottom-right img {
				width:auto;
			}
		</style>
		<?}?>

	</div>	
	<? } ?>
</div>

<style>
<?=$widget_config['css']?>
</style>
