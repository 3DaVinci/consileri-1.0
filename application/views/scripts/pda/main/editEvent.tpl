{if $error!=""}<span class="size2">{$error}</span>{/if}
<form action="{$siteurl}/mainpda/editEventSubmit" method="POST">
<table>
<tr>
<td valign="top">
<input type="text" name="name" tabindex="1" style="width:150px" value="{$name}"><br>
<textarea name="comment" wrap="on" tabindex="2" style="width:150px; height:50px;">{$comment}</textarea>
</td>
<td valign="top">
<input type="hidden" name="id" value="{$id}">
<input type="Submit" value="{t}Изменить{/t}"><br>
</td>
</tr>
</table>
</form>