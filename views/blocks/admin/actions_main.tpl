[{if $edit->oxactions__oxtype->value == 3}]
  <tr>
    <td class="edittext" width="70">
      [{oxmultilang ident="BANNER_OXID"}]
    </td>
    <td class="edittext">
    [{$edit->oxactions__oxid->value}]
    [{oxinputhelp ident="HELP_BANNER_OXID"}]
    </td>
  </tr>
[{/if}]

[{$smarty.block.parent}]
