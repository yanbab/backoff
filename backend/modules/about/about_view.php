<!-- About view -->

<style>
#main {
    padding: 20px;
    padding-top: 0px;
    line-height: 1.6em;
}
.plugin {
    margin-bottom : 5px;
}
h2 {
    margin-top: 20px;
    margin-bottom:10px;
}
.plugin small {
    color : #AAA;
}
</style>

<div id="toolbar">
  <h2><?= lang('About');?></h2>
</div>


<div id="main">

<h2>System</h2>
PHP Version :<strong> <?php echo phpversion(); ?></strong><br>
Backoff version :<strong><?php echo VERSION; ?></strong><br>

<h2>Plugins</h2>
<?php foreach ($plugins as $plugin) : ?>
    <div class="plugin">
        <img src="<?=url_base() . "plugins/$plugin/$plugin.png";?>" align="absmiddle" hspace="6">
        <strong><?php eval("echo $plugin" . "Plugin::description;");?></strong>    
        <small>(<?php echo $plugin; ?>)</small>
    </div>
<?php endforeach; ?>


<!-- Logs -->

<h2>Logs</h2>
  <table class="list" style="border:solid #aaa 1px">
    <thead>
      <tr>
        <th>#</th>
        <th>Access</th>
        <th>User</th>
        <th>Message</th>
        <th>URL</th>
        <th>IP adresse</th>
    </tr>
</thead>


<?php foreach ($log as $line) : ?>
    <tr  >
      <td>#<?php echo $line[0]; ?></td>          
      <td  class="em" nowrap="nowrap"><?php echo $line[1]; ?></td>          
      <td class="em"><?php echo $line[2]; ?></td>          
      <td class="em"><?php echo $line[3]; ?></td>          
      <td class="em" nowrap="nowrap"><?php echo $line[4]; ?></td>          
      <td class="em"><?php echo $line[5]; ?></td>          
  </tr>
<?php endforeach; ?>        
</table>
</div>
