<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
?>

<form action="./_form/accept.php" method="post" enctype="multipart/form-data">
  <input id="lefile" type="file" multiple="multiple" name="fname" style="display:none">
  <div class="input-group">
    <select class="custom-select" name="fold">
      <option selected>directory?</option>
      <option value="1/">1/</option>
      <option value="2/">2/</option>
      <option value="3/">3/</option>
    </select>
    <input type="text" id="photoCover" class="form-control" placeholder="select file...">
    <span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input[id=lefile]').click();">Browse</button></span>
    <span><input type="submit" class="btn btn-primary" value="Upload"></span>
  </div>
</form>
<!--<p class="help-block">
  Upload .md or .html here! <br>
  They'll be displayed in github-markdown style.
</p>
-->

<script>
  $('input[id=lefile]').change(function() {
    $('#photoCover').val($(this).val().replace("C:\\fakepath\\", ""));
  });
</script>