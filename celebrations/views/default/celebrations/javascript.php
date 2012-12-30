<?php
/**
 * Filters in Celebrations lists
 *
 * @package Celebrations plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009
 * @link
 * for Elgg 1.8 by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 */

 global $CONFIG, $month;
?>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj){
  eval(targ+".location='<?php echo $CONFIG->wwwroot . "mod/celebrations/index.php?month=".$month."&filterid=" ?>"+selObj.options[selObj.selectedIndex].value+"'");
}
</script>
