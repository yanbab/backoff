<?php print_r($_POST);

$field = $_POST['field'];

$req = '<sup class="req">*</sup>';

?>
    <!-- Sexy-combo jquery plugin -->
    <link href="<?=url_base();?>modules/builder/sexy-combo/sexy-combo.css" rel="stylesheet" type="text/css" />
    <link href="<?=url_base();?>modules/builder/sexy-combo/sexy.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=url_base();?>modules/builder/sexy-combo/jquery.sexy-combo-2.0.6.min.js"></script>

<style>
label {
    float : left;
    padding-top : 4px;
    width : 100px;
}

p {
}
input,select {
    margin-bottom : 8px;
}

#list_field{
    width : 150px;
    height : 100%;
    background : #ccc;
    float : left;
    
}

#form_field{
    margin-left : 150px;
    background : #F5F5F5;
    padding : 20px;
}
#builder {
    border : solid #ccc 2px;
    border-radius : 2px;
    -moz-border-radius : 3px;
    margin : 10px 20px;
}
.req {
    color : #F33;
    margin-left : 0.5em;
}
#advanced_options {
display:none;
background : #eee;
padding : 1em;

}
#advanced_options_button {
display:block;

font-weight : bold;
padding : 15px 0;
}

/** Field list */
#list_field ul li {
    list-style:none;
}
#list_field ul li a{
    display:block;
    padding : 3px 6px;
    margin-left : 0.5em;
}
#list_field ul li.selected  a{
    font-weight : bold;
    background : #eee;
    border-radius:3px 0 0 3px;
    -moz-border-radius:5px 0 0 5px;
}

#list_field ul {
    margin:0;padding:0;
}

.input_helper {
    position : relative;
}

.input_helper_menu {
    position : absolute;
}

</style>

<div id="builder">
<div id="list_field">
<ul>
    <li><b>Pages</b></li>
</ul>
<ul>
    <li class="text selected"><a href="">Name</a></li>
    <li class="text"><a href="">Sujet</a></li>
    <li class="textarea"><a href="">De</a></li>
    <li class="color selected"><a href="">à</a></li>
    <li><a href="">Contenu</a></li>
    <li><a href="">Name</a></li>
    <li><a href=""><i>+ Add field</i></a></li>
</ul>

</div>

<div id="form_field">

<form method="post">
<p><label>Name<?=$req?></label><input name="field[name]" value="<?=htmlentities($field[name])?>" size="30"></p>

<p><label>Description</label><input name="field[description]" value="<?=$field[description]?>" size="30"></p>

<p><label>Database field<?=$req?></label>
<div class="input_helper">
    <input name="field[id]" value="<?=$field[id]?>" size="30"><a href="">v</a>
    <ul class="input_helper_menu">
        <li>id</li>
        <li>name</li>
        <li>content</li>
    </ul>
</div>
</p>
</p>




<p><label>Type *</label><select name="field[type]" id="plugin_selector"  value="<?=$_POST[field][type]?>" >
    <option value="text">Line of text</option>
    <option value="textarea">Text</option>
    <option value="richtext">Rich Text</option>
    <option value="number">Number</option>
    <option value="password">Password</option>
    <option value="select">Choices</option>
</select>
</p>

<div id="options">
     <div id="options_select"  class="option">
        <p><label>Choices</label>
        <textarea rows="4" cols="10"></textarea>

     </div>
     <div id="options_password" class="option">
        <p><label>Encryption</label>
    <select name="" id="">
    <option value="text">MD5</option>
    <option value="textarea">SHA1</option>
    <option value="richtext">PASSWORD</option>
    <option value="number">None</option>
</select>
     </div>
     
        
        
</div>

<a  id="advanced_options_button" href="#">Show advanced options</a>


    <div id="advanced_options">

        <div>
        <p><label>Permissions</label>
            <input type=checkbox>Edit
            <input type=checkbox>Create
            <input type=checkbox>Delete
        </p>
        </div>

<br>
        <div>
        <label>Actions</label>
            <input type=checkbox>Export
            <input type=checkbox>Duplicate
            <input type=checkbox>Delete
        </div>
<br>
        <div >
        <p><label>Show in</label>
            <input type=checkbox>List view
            <input type=checkbox>Edit view
        </p>
        </div>
<br>
        <div >
        <p><label>Validation</label>
        <select>
            <option>Required</option>
            <option>Mail</option>
            <option>Matches</option>
        </select>

        </p>
        </div>

    </div>


        <p>
        <input type="submit" value="Delete" style="float:right">
        <input type="submit" value="Save"> or <a href="#">Cancel</a> 
        </p>
</div>

</div>

</div>
<script>
$(function() {
   // $('SELECT').sexyCombo();
    $('#advanced_options_button').click( function () {
        $('#advanced_options').toggle();
        return false;
    });
    
    $('#plugin_selector').change( function () {
        $('.option').hide();
        $('#options_' + $(this).val()).show();        

    });
    // Init
    $('#plugin_selector').trigger('change');
});
</script>
