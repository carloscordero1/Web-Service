<html>
<head>
<title>The Weeknd Web Service Demo</title>
<style>
  
body {font-family:georgia;}

.album{
border:1px solid #E77DC2;
border-radius: 5px;
padding: 5px;
margin-bottom:5px;
position:relative;   
}
  
.pic{
position:absolute;
right:10px;
top:10px;
}


</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

  function bondTemplate(album){
    return `<div class="album">
    <b>Album: </b> ${album.Album}<br />    
    <b>Title: </b> ${album.Title}<br />
    <b>Label: </b> ${album.Label}<br />
    <b>Year: </b> ${album.Year}<br />     
    <b>Writers: </b> ${album.Writers}<br />    
    <div class="pic"><img src="thumbnails/${album.Image}"/></div>
  </div>`;
  }

$(document).ready(function() {  

  $('.category').click(function(e){
    e.preventDefault(); //stop default action of the link
    cat = $(this).attr("href");  //get category from URL
      
    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);
      //Place the title of the webservice on page
      $("#filmtitle").html(data.title);

      //clear previous films
      $("#films").html("");

      //load each film via template into div
      $.each(data.albums, function(key, value){
          let str = bondTemplate(value);
          $("<div></div>").html(str).appendTo("#albums");
      });

      
      //load data on page so we can see it
      //$("#output").text(JSON.stringify(data));

      /*  let myData = JSON.stringify(data, null, 4);

      myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);
    */
      
    });
    request.fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
           });
	});
});	


</script>
</head>
	<body>
	<h1>The Weeknd Web Service</h1>
		<a href="year" class="category">The Weeknd Albums By Year</a><br />
		<h3 id="albumtitle">Title Will Go Here</h3>
    
		<div id="albums">
			<p>Albums will go here</p>
		</div>
<!--
  <div class="film">
    
    <b>Film: </b> 1<br />    
    <b>Title: </b> Dr. Yes<br />    
    <b>Year: </b> 1962<br />    
    <b>Director: </b> Terence Young<br />    
    <b>Producers: </b> Harry Saltzman and Albert R. Broccoli<br />   
    <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />    
    <b>Composer: </b> Monty Norman<br />   
    <b>Bond: </b> Sean Connery<br />    
    <b>Budget: </b> $1,000,000.00<br />
    <b>BoxOffice: </b> $59,567,035.00<br />
    <div class="pic"><img src="thumbnails/dr-no.jpg"/> </div>
   
  </div>
-->

    
		<div id="output">Results go here</div>
	</body>
</html>