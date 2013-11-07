<!-- About view -->

<div id="toolbar">
  <h2><?= lang('About');?></h2>
</div>


<div id="main">

  <table class="list">
    <thead>
      <tr>
        <th width="16"></th>
        <th>Description</th>
        <th>Plugin name</th>
      </tr>
    </thead>
  <?php foreach ($plugins as $plugin) : ?>
    <tr>
      <td><img src="<?=url_site() . "plugins/$plugin/$plugin.png";?>"></td> 
      <td><strong><?php eval("echo $plugin" . "Plugin::description;");?></strong></td>         
      <td nowrap="nowrap"><?php echo $plugin; ?></td>          
   </tr>
  <?php endforeach; ?>
  </table>
<div style="height:20em;overflow : auto;">
  <table class="list">
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
</div>
