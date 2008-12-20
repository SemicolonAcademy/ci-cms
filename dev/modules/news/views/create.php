<!-- [Left menu] start -->
<div class="leftmenu">

	<h1 id="pageinfo"><?php echo __("Quick links", $this->template['module'])?></h1>
	
	<ul id="tabs" class="quickmenu">
		<li><a href="#one"><?php echo __("Content", $this->template['module'])?></a></li>
		<li><a href="#two"><?php echo __("Options", $this->template['module'])?></a></li>
	</ul>
	<div class="quickend"></div>

</div>
<!-- [Left menu] end -->

<!-- [Content] start -->
<div class="content slim">

<script type="text/javascript">

$(document).ready(function ()
{
	$('input#date').datePicker({startDate:'01/01/1996'});
});


$(document).ready(function(){
	$("#image")
	.after("<img src='<?php echo site_url('application/views/admin/images/ajax_circle.gif')?>' id='loading'/><input type='button' id='upload_now' value='  <?php echo __('Upload') ?>  ' />");
	$("#loading").hide();
	$("#upload_now").click(function(){
		ajaxFileUpload();
	});
	handleDeleteImage();
});

function handleDeleteImage() {
	$("a.ajaxdelete").click(function(){
		if (confirm("Delete image?"))
		{
		deleteImage(this);
		return false;
		} else {
		return false;
		}
	});
}
function deleteImage(obj) {
	var id = obj.id
	$.post('<?php echo site_url('admin/news/ajax_delete')?>',
		{ id: id},
		function(data){
			alert(data);
		}
	);
	$(obj).parent().hide();
}

function ajaxFileUpload() {
	$("#upload_now")
	.ajaxStart(function(){
		$("img#loading").show();
		$(this).hide();
	})
	.ajaxComplete(function(){
		$("img#loading").hide();
		$(this).show();
	});

	$.ajaxFileUpload
	(
		{
			url:'<?php echo site_url('admin/news/ajax_upload')?>',
			secureuri:false,
			fileElementId: 'image',
			dataType: 'json',
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						alert(data.error);
					}else
					{
						$("#image_list").append("<div><input type='hidden' name='image_ids[]' value='"+data.imageid+"' /><a href='#' onclick=\"tinyMCE.execCommand('mceInsertContent',false,'<a href=\\'<?php echo site_url('media/images/o') ?>/"+data.image+"\\'><img border=0 align=left hspace=10 src=\\'<?php echo site_url('media/images/m') ?>/"+data.image+"\\'></a>');return false;\">"+data.image+"</a> - <a href='#'  class=\"ajaxdelete\" id='"+data.imageid+"' ><?php echo __('Delete image')?></a></div>\n");
						$("#image").val("");
						handleDeleteImage();
						
					}
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)
	return false;
}
</script>

<h1 id="edit"><?php echo (isset($row['id'])? __("Edit news", $this->template['module']):__("Create News", $this->template['module']))?></h1>

<form  enctype="multipart/form-data" class="edit" action="<?php echo site_url('admin/news/save')?>" method="post" accept-charset="utf-8">
		<input type="hidden" name="id" value="<?php echo (isset($row['id'])?$row['id'] : "") ?>" />
		<input type="hidden" name="lang" value="<?php echo $this->user->lang ?>" />
		<ul>
			<li><input type="submit" name="submit" value="<?php echo __("Save", $this->template['module'])?>" class="input-submit" /></li>
			<li><a href="<?php echo site_url('admin/news')?>" class="input-submit last"><?php echo __("Cancel", $this->template['module'])?></a></li>
		</ul>
		
		<br class="clearfloat" />

		<hr />

		<?php if ($notice = $this->session->flashdata('notification')):?>
		<p class="notice"><?php echo $notice;?></p>
		<?php endif;?>
		
		<div id="one">
		
		<p><?php echo __("To create a news, just fill in your content below and click 'Save'.<br />If you want to save your progress without publishing it, Select 'Draft' status.", $this->template['module'])?></p>

		<label for="title"><?php echo __("Title", $this->template['module'])?>:</label>
		<input type="text" name="title" value="<?php echo (isset($row['title'])?$row['title'] : "") ?>" id="title" class="input-text" /><br />
		
		<label for="pid"><?php echo __("Category", $this->template['module'])?>:</label>
		<select name='cat' id='cat' class="input-select">
		<option value='0'></option>
		<?php if($categories): ?>
		<?php foreach($categories as $category) : ?>
			<option value="<?php echo $category['id']?>" <?php echo ($row['cat'] == $category['id'])?"selected":""?>> &nbsp;<?php echo ($category['level'] > 0) ? "|".str_repeat("__", $category['level']): ""?> <?php echo $category['title'] ?> </option>
		<?php endforeach; ?>
		<?endif;?> 
		</select><br />
		
		
		
		<label for="status"><?php echo __("Status", $this->template['module'])?>:</label>
		<select name="status" id="status" class="input-select">
			<option value="1" <?php echo (isset($row['status']) && $row['status'] == 1)? "selected"  : "" ?>><?php echo __("Published", $this->template['module'])?></option>
			<option value="0" <?php echo (isset($row['status']) && $row['status'] == 0)? "selected"  : "" ?>><?php echo __("Draft", $this->template['module'])?></option>
		</select><br />
		
		<label for="body"><?php echo __("Content", $this->template['module'])?>:</label>
		<textarea name="body" class="input-textarea"><?php echo (isset($row['body'])?$row['body'] : "") ?></textarea><br />

		<div id='image_list'>
		<div style="visibility: hidden">Available images:</div>
		<?php if ($images) : ?>
		<?php foreach($images as $image): ?>
		<div><input type='hidden' name='image_ids[]' value='<?php echo $image['id'] ?>' /><a href='#' onclick="tinyMCE.execCommand('mceInsertContent',false,'<a href=\'<?php echo site_url('media/images/o')?>/<?php echo $image['file'] ?>\'><img border=\'0\' align=\'left\' hspace=\'10\' src=\'<?php echo site_url('media/images/m')?>/<?php echo $image['file'] ?>\' /></a>');return false;"><?php echo $image['file'] ?></a> - <a href="<?php echo site_url('admin/news/removeimg/' . $image['id']) ?>" class="ajaxdelete" id="<?php echo $image['id'] ?>"><?php echo __("Delete image", $this->template['module']) ?></a></div>
		<?php endforeach; ?>
		<?php endif;?>
		</div>
		
		<label for="image"><?php echo __("Image", $this->template['module'])?></label>
		<input type="file" name="image" class="input-file" id="image"/><br />
		</div>
		<div id="two">
		
			<label for="date"><?php echo __("Date", $this->template['module'])?> (dd/mm/yyyy):</label>
			<input type="text" name="date" value="<?php echo (isset($row['date'])?date("d/m/Y", $row['date']) : date("d/m/Y")) ?>" id="date" class="input-text" /><br class='clear'/>

		
			<label for="allow_comments"><?php echo __("Allow Comments", $this->template['module'])?>:</label>
			<select name="allow_comments" class="input-select" id="allow_comments">
			<option value='1' <?php echo (($row['allow_comments']==1)?"selected":"")?>><?php echo __("Yes", $this->template['module'])?></option>
			<option value='0' <?php echo (($row['allow_comments']==0)?"selected":"")?>><?php echo __("No", $this->template['module'])?></option>
			</select><br />

			<label for="notify"><?php echo __("Notify me for comments", $this->template['module'])?>:</label>
			<select name="allow_comments" class="input-select" id="allow_comments">
			<option value='1' <?php echo (($row['notify']==1)?"selected":"")?>><?php echo __("Yes", $this->template['module'])?></option>
			<option value='0' <?php echo (($row['notify']==0)?"selected":"")?>><?php echo __("No", $this->template['module'])?></option>
			</select><br />


			<?php
			$custom_fields = "";
			
			echo $this->plugin->apply_filters("news_custom_fields", $custom_fields, $row['id']);

			?>
			
			
		</div>
	</form>
<script>

  $(document).ready(function(){
    $("#tabs").tabs();
  });

</script>	
</div>
<!-- [Content] end -->