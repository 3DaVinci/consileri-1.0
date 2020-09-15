{literal}
<script language="JavaScript" type="text/javascript">
  function insertDummy() {
  	$('people').value = $('people').value + '{/literal}{t escape=none}Петр Семёныч, директор, 8-999-345-2335, dir@glavdir.ru, любит спаниелей и охоту, ДР 12.01.1975{/t}{literal}';
	$('people').value = $('people').value + '\n\n';
	$('people').value = $('people').value + '{/literal}{t escape=none}Кривцова Маргарита Васильевна, главбух, 34-53-22{/t}{literal}';
	$('people').value = $('people').value + '\n\n';
	$('people').value = $('people').value + '{/literal}{t escape=none}Миша, сисадмин, раздолбай, mihaogo@asdf.ru{/t}{literal}';
  }
</script>
  
{/literal}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:11px;color:#818080;font-weight:normal"><span style="color:#17b80b">#</span> {t}контактные лица через пустую строку, данные через запятую{/t} (<span style="border-bottom:1px dashed; cursor:pointer" onclick="insertDummy()">{t}вставить образец{/t}</span>)</span>
