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


<div class="hidden" id="lefttip">{$prevmonth}</div></td>
<td><a href="{$siteurl}/journal?scale=3&y={$py}&m={$pm}&manager={$manager}">
<div id="scroolbuttonleft" onmouseover="showElement('lefttip')" onmouseout="hideElement('lefttip')"></div></a></td>
<td nowrap>{$nowmonth}</td>
<td><a href="{$siteurl}/journal?scale=3&y={$ny}&m={$nm}&manager={$manager}">
<div id="scroolbuttonright" onmouseover="showElement('righttip')" onmouseout="hideElement('righttip')" style="display: {if $isFuture}none{else}block{/if}"></div></a></td>
<td nowrap><div class="hidden" id="righttip">{$nextmonth}</div></td>
</tr>
</table>
