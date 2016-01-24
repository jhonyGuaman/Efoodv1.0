<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
$(document).ready(function(){
       alert("Height of div: " + $("#resul").height());
       $('#Dizq').css('height', $("#resul").height()+'px');
       alert("tamano del div izq"+ $("#Dizq").height());
    
});
</script>
</head>
<body>
<div class="row">
	<div class="col-lg-12">
	<div class="col-lg-6">
<div id="resul" style="height:100px;width:200px;padding:10px;margin:3px;border:1px solid blue;background-color:lightblue;"></div>
</div>
	<div class="col-lg-6">
<div id="Dizq"class="izq" style="padding:10px;height:50px; width:200px;border:1px solid red;margin:3px;background-color:lightblue;"></div>
</div>
</div>
<br>

</row>

<button>Display the height of div</button>

</body>
</html>
