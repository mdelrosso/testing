{* Smarty *}
<table width="500" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td>Hello, {$name}!</td>
      </tr>
    </table></td>
  </tr>
</table>

<select name="company">
  {html_options options=$choices selected=$selected}
</select>

