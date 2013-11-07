



<div id="toolbar">
  <h2><?= lang('Access log');?></h2>
</div>


<div id="main">


  <form>

    
  
  </form>



  <table class="list">

    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>User</th>
        <th>Message</th>
        <th>URL</th>
        <th>IP adresse</th>
      </tr>
    </thead>
<?php foreach ($log as $line) : ?>
    <tr>
      <td>#<?php echo $line[0]; ?></td>          
      <td nowrap="nowrap"><?php echo $line[1]; ?></td>          
      <td><?php echo $line[2]; ?></td>          
      <td><?php echo $line[3]; ?></td>          
      <td nowrap="nowrap"><?php echo $line[4]; ?></td>          
      <td><?php echo $line[5]; ?></td>          
   </tr>
<?php endforeach; ?>        
  </table>

</div>
