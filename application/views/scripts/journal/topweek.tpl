<td nowrap>

{literal}
<script>
	function showElement(elem) {
		$(elem).style.visibility = 'visible';
	}
	
	function hideElement(elem) {
		$(elem).style.visibility = 'hidden';
	}
	
</script>
{/literal}


<div class="hidden" id="lefttip">{$prevweek}</div></td>
<td><a href="{$siteurl}/journal?scale=2&y={$py}&m={$pm}&d={$pd}&manager={$manager}">
<div id="scroolbuttonleft" onmouseover="showElement('lefttip')" onmouseout="hideElement('lefttip')"></div></a></td>
<td nowrap>{$nowweek}</td>
<td><a href="{$siteurl}/journal?scale=2&y={$ny}&m={$nm}&d={$nd}&manager={$manager}">
<div id="scroolbuttonright" onmouseover="showElement('righttip')" onmouseout="hideElement('righttip')" style="display: {if $isFuture}none{else}block{/if}"></div></a></td>
<td nowrap><div class="hidden" id="righttip">{$nextweek}</div></td>
</tr>
</table>
