<html>
  <head>
    <title>Space Shooter 2012</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Michroma|Orbitron' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>

<?php  
if (!empty($_GET['name'])){
    $username=$_GET['name'];
}
?>

</script>
<style>
	#canvasCenter{
		cursor:crosshair;
	}
</style>
</head>
  <body>
      <h1>Light Speed</h1>
    <div id="canvasCenter"><canvas width="1024" height="768" id="canvas"></canvas><div id="overlay"></div></div>
    <script>




var canvas = document.getElementById('canvas');
var c = canvas.getContext('2d');
var keyboard = { };
var shipimage= {};
var playerBullets = [];
var tick = 0;
var mtick = 0;
var btick = 0;
var points = 0;

loadResources();
function loadResources() {
  ship_image = new Image();
  ship_image.src = "images/Spaceship2.png";
  
  meteor1_image = new Image();
  meteor1_image.src = "images/meteor2.png";

  bullet1_image = new Image();
  bullet1_image.src = "images/bullets-1.png";  

  explosion_image = new Image();
  explosion_image.src = "images/explosion.png";
  
  //Sound resources
  gun = new Audio("sound/shoot.wav");
  asteroid = new Audio("sound/asteroid.wav");
  splosion = new Audio("sound/ship.wav");

}

//draw background
c.fillStyle = "black";
c.fillRect(0,0,1024,768);

var game = {
    state: "start",
};

//define ship
ship ={
  counter:0,
  s:15,
  r:75,
  x:512,
  y:384,
  z:15
};
  
var meteors = [];

var overlay = {
    counter: -1,
    title: "foo",
    subtitle: "bar",
	scoreTitle: "rable",
	score: "rabble",
};

var overlay2 = {
    counter: -1,
	scoreTitle: "SCORE:",
	score: points,
};

function mainLoop() {
  var c = canvas.getContext('2d');
  
  updateGame();
  updateMovement();
  collision();
  updatePlayerBullets();
  
  clearCanvas(c);
  drawMeteors(c);
  drawShip(c);
  drawScore(c);
  drawOverlay(c);
  drawPlayerBullets(c);
};

function updateGame() {

  if(game.state == "over" && keyboard[32]) {
    $('#overlay').empty();
    game.state = "start";
    ship.state = "alive";
    overlay.counter = -1;
    meteors = [];
	points = 0;
	overlay2.score = points;
  }
  if(game.state == "won" && keyboard[32]) {
    game.state = "start";
    ship.state = "alive";
    overlay.counter = -1;
    meteors = [];
	points = 0;
	overlay2.score = points;
  }
  
  if(overlay.counter >= 0) {
    overlay.counter++;
  }
};

setInterval(function(){
  s=Math.random();
  t=Math.random();
    var meteor ={
      dir:Math.floor(Math.random()*360),
      s:Math.random(),
      //r:Math.floor((15-12+1)*Math.random()+12),
      r:15,
      x:2048 * Math.cos(s) * Math.sin(t) -512,
      y:2048 * Math.sin(s) * Math.sin(t)-631,
      z:1024 * Math.cos(t)
    };
    meteors.push(meteor);
    meteors.sort(function (a, b) {
        return a.z < b.z;
    });

  },40);

function collision(){
  if(ship.state == "hit" || ship.state == "dead") return;
  for(var i in meteors) {
    var meteor = meteors[i];
    xsqr = ship.x - meteor.x;
    xsqr = xsqr * xsqr;
    ysqr = ship.y - meteor.y;
    ysqr = ysqr * ysqr;
    zsqr = ship.z - meteor.z;
    zsqr = zsqr * zsqr;
    dis = Math.sqrt(xsqr + ysqr + zsqr)-ship.r-meteor.r;
    if (dis <= 0) {
      ship.state= "hit";
    name = '<?php echo $_GET["name"]; ?>';
    score = points;
    }
  };
};

function updateMeteorCollision(x, y) {
	for(var i in meteors) {
		var meteor = meteors[i];
		xsqr = x - meteor.x;
		xsqr = xsqr * xsqr;
		ysqr = y - meteor.y;
		ysqr = ysqr * ysqr;
		dis = Math.sqrt(xsqr + ysqr)-meteor.r;
		if (dis <= 0) {
			meteors.splice(i, 1);
			drawMeteorExplosion(x,y);
			points += 10;
			overlay2.score = points;
		}
  };
};

function updateMovement(){
  
  if(ship.state == "hit") {
    ship.counter++;

    if(ship.counter >= 40) {

//game score screen
  $.post('whatever.php', {Name: name, Score: points},
      function(data){
      $("#overlay").html(data);
      });
//end game score screen
      ship.counter = 0;
      ship.state = "dead";
      game.state = "over";
      overlay.title = "GAME OVER";
      overlay.subtitle = "press space to play again";
      overlay.scoreTitle = "SCORE:";
	  overlay.score = points;
      overlay.counter = 0;
	  points = 0;
	  overlay2.score = points;
    };



  };
  
  if (keyboard[37] || keyboard[65] || keyboard[39] || keyboard[68] || keyboard[38] || keyboard[87] || keyboard[40] || keyboard[83]){
    angleturned = ship.s/100;
    xTraveled = 50* Math.cos(angleturned);
    zTraveled = 50 * Math.sin(angleturned);
    
    //left and up arrow || a w
    if ((keyboard[37] && keyboard[38]) || (keyboard[65] && keyboard[87]))  { 

      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        meteor.x = meteor.x - (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y - (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
      };
      if (ship.x > 387){
      ship.x -= 5/1.33;
      };
      if (ship.y > 287){
      ship.y -= 5/1.33;
      };
      return
    }
    //right and up arrow || d w
    else if ((keyboard[39] && keyboard[38]) || (keyboard[68] && keyboard[87]))  { 
      
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        meteor.x = meteor.x + (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y - (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
      };
      if (ship.x < 687){
      ship.x += 5/1.33;
      };
      if (ship.y > 287){
      ship.y -= 5/1.33;
      };
      return
    }
    //left and down arrow || a s
    else if ((keyboard[37] && keyboard[40]) || (keyboard[65] && keyboard[83]))  { 
      
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        meteor.x = meteor.x - (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y + (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
      };
      if (ship.x <387){
      ship.x -= 5/1.33;
      };
      if (ship.y < 487){
      ship.y += 5/1.33;
      };
      return
    }
    //right and down arrow || d s
    else if ((keyboard[39] && keyboard[40]) || (keyboard[68] && keyboard[83]))  { 
      
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        meteor.x = meteor.x + (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y + (Math.cos(meteorangle)*meteorhypo/1.33)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
      };
      if (ship.x <687){
      ship.x += 5/1.33;
      };
      if (ship.y < 487){
      ship.y += 5/1.33;
      };
      return
    }
    //left arrow || a
    if(keyboard[37] || keyboard[65])  { 

      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - (Math.sin(meteorangle)*meteorhypo);
        
        meteor.x = meteor.x - (Math.cos(meteorangle)*meteorhypo)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y + ((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
        
      };
      if (ship.x > 387){
        ship.x -= 5;
      };
    }	
    //right arrow || d
    else if (keyboard[39] || keyboard[68]) { 
      
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        
        meteor.x = meteor.x + (Math.cos(meteorangle)*meteorhypo)+((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y + ((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);

      };
      if (ship.x < 687){
        ship.x += 5;
      };

    }
    //up arrow || w
    else if (keyboard[38] || keyboard[87])  {
      console.log('up');
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        
        meteor.x = meteor.x + ((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y - (Math.cos(meteorangle)*meteorhypo)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);

      };
      if (ship.y > 287){
        ship.y -= 5;
      };
    }
    //down arrow || s
    else if (keyboard[40] || keyboard[83])  { 
      
      for(var i in meteors) {
        var meteor = meteors[i];
        meteorhypo = Math.sqrt( (meteor.z - zTraveled)^2 + xTraveled^2 );
        meteorangle = 90-(angleturned - Math.asin(zTraveled/meteorhypo));
        
        meteor.z = meteor.z - Math.sin(meteorangle)*meteorhypo;
        meteor.x = meteor.x + ((meteor.x-512)/meteor.z)+ (meteor.s * ship.s * Math.cos(meteor.dir));
        meteor.y = meteor.y + (Math.cos(meteorangle)*meteorhypo)+((meteor.y-384)/meteor.z)+ (meteor.s * ship.s * Math.sin(meteor.dir));
        meteor.r = meteor.r + (102.4/meteor.z);
      };
      if (ship.y < 487){
      ship.y += 5;
      };
    }
    
  }else{
    for(var i in meteors) {
      var meteor = meteors[i];
      meteor.z = meteor.z - (meteor.s * ship.s);
      meteor.r = meteor.r +(102.4/meteor.z);
      meteor.x = meteor.x+((meteor.x-512)/meteor.z);
      meteor.y = meteor.y+((meteor.y-384)/meteor.z);
      meteor.x = meteor.x + (meteor.s * ship.s * Math.cos(meteor.dir));
      meteor.y = meteor.y + (meteor.s * ship.s * Math.sin(meteor.dir));
      if (meteor.z < -500){
        $(meteor).remove();
      }
    };
    if (ship.x != 512){
      ship.x += (512-ship.x)/20;
    }
    if (ship.y != 384){
      ship.y += (384-ship.y)/20;
    }
  };
  if(mouse.down) {
		
		firePlayerBullet();
		mouse.down = false;
		
	};
};

function getMousePos(canvas, evt){
    // get canvas position
    var obj = canvas;
    var top = 0;
    var left = 0;
    while (obj.tagName != 'BODY') {
        top += obj.offsetTop;
        left += obj.offsetLeft;
        obj = obj.offsetParent;
    }
 
    // return relative mouse position
    var mouseX = evt.clientX - left + window.pageXOffset;
    var mouseY = evt.clientY - top + window.pageYOffset;
    return {
        x: mouseX,
        y: mouseY
    };
};

function updatePlayerBullets() {
		//console.log(mouse.pos.x);
		//console.log(mouse.pos.y);
		
		//move each bullet
		for(i in playerBullets) {
			var bullet = playerBullets[i];
			var DistX = bullet.mx - bullet.x;
			var DistY = bullet.my - bullet.y;
			bullet.x += 40 * (DistX / (Math.abs(DistX) + Math.abs(DistY)));
			bullet.y += 40 * (DistY / (Math.abs(DistX) + Math.abs(DistY)));
			
			var distance = Math.sqrt(DistX ^ 2 + DistY ^ 2);
			
			if(DistY < 0){
				if(bullet.y < bullet.my){
					playerBullets.splice(i, 1);
				};
			};
			if(DistY > 0){
				if(bullet.y > bullet.my){
					playerBullets.splice(i, 1);
				};
			};
			if(DistX < 0){
				if(bullet.x < bullet.mx){
					playerBullets.splice(i, 1);
				};
			};
			if(DistX > 0){
				if(bullet.x > bullet.mx){
					playerBullets.splice(i, 1);
				};
			};
			updateMeteorCollision(bullet.x, bullet.y);
			bullet.counter++;
		};
	//remove the ones that are off the screen

};

function clearCanvas(c){
  c.fillStyle = "black";
  c.fillRect(0,0,1024,768);
};

function drawShip(c){
  if(ship.state == "dead") return;
    
  if(ship.state == "hit") {
    drawShipExplosion(c);
    return;
  };

  shipimage.y = ship.y-45;
  shipimage.x = ship.x-72;
  if (ship.x < 387){
    c.drawImage(ship_image,
      0,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x < 437 && ship.x > 387){
    c.drawImage(ship_image,
      144,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x < 487 && ship.x > 437){
    c.drawImage(ship_image,
      288,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x < 537 && ship.x > 487){
    c.drawImage(ship_image,
      432,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x < 587 && ship.x > 537){
    c.drawImage(ship_image,
      576,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x < 637 && ship.x > 587){
    c.drawImage(ship_image,
      720,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
  if (ship.x > 637){
    c.drawImage(ship_image,
      864,0,144,90,
      shipimage.x, shipimage.y, 144,90 
    );
  }
};

function firePlayerBullet() {
	//create a new bullet
	playerBullets.push({
		x: ship.x,
		y: ship.y - 5,
		width:10,
		height:10,
		mx: mouse.pos.x,
		my: mouse.pos.y,
	});
  //Play laser sound when bullet is fired
  gun.currentTime=0;
  gun.play();
};

function drawPlayerBullets(c) {
	//c.fillStyle = "blue";
	for(i in playerBullets) {
		var bullet = playerBullets[i];
		//c.fillRect(bullet.x, bullet.y, bullet.width,bullet.height);
      c.drawImage(
        bullet1_image, // the image of the sprite sheet
        0,0,21,21, // source coords inside sheet (x,y,w,h)
        (bullet.x-10),(bullet.y-10),21,21 // destination coordinates on canvas (x,y,w,h)
      );
	};
};

function drawMeteors(c){
  for(var i in meteors) {
    var meteor = meteors[i];
    var v = Math.floor(255- meteor.z/4);
    if ((meteor.z > 0) && (meteor.x > -50) && (meteor.x < 1074) && (meteor.y > -50) && (meteor.y < 826)){
      c.moveTo(meteor.x,meteor.y);
      var count = Math.floor(meteors.length/1.5);
      var xoff = (count%4)*72;

      c.drawImage(
      meteor1_image,
      xoff+0,0,72,72,
      meteor.x,meteor.y,meteor.r*2,meteor.r*2
    );
    };
  };
};

var particles = [];
function drawShipExplosion(c) {
  //Play explosion sound when bhit
  splosion.play();
  //start
  if(ship.counter == 0) {
    particles = []; //clear any old values
    for(var i = 0; i<50; i++) {
      particles.push({
        x: ship.x,
        y: ship.y,
        xv: (Math.random()-0.5)*2.0*5.0,  // x velocity
        yv: (Math.random()-0.5)*2.0*5.0,  // y velocity
        age: 0,
      });
    };
    function drawBoom(){
      var frame = tick % 16; //7 is the number of frames in the sprite sheet
      var x3 = frame * 64; //48 is the width of each frame
      c.drawImage(
        explosion_image, // the image of the sprite sheet
        x3,0,64,62, // source coords inside sheet (x,y,w,h)
        (ship.x-32),(ship.y-31),64,62 // destination coordinates on canvas (x,y,w,h)
      );
      tick++;
    };
    var intervalBoom = setInterval(drawBoom,1000/30);
    setTimeout(function() { clearInterval(intervalBoom)}, 480);
  };
  
  if(ship.counter > 0) {
    for(var i=0; i<particles.length; i++) {
      var p = particles[i];
      p.x += p.xv;
      p.y += p.yv;
      var v = 255-p.age*3;
      c.fillStyle = "rgb("+v+","+v+","+v+")";
      c.fillRect(p.x,p.y,3,3);
      p.age++;
    };
  };
};

function drawMeteorExplosion(x,y) {
    asteroid.currentTime = 0;
    asteroid.play();
  //start
  if(ship.counter == 0) {
    particles = []; //clear any old values
    for(var i = 0; i<50; i++) {
      particles.push({
        x: x,
        y: y,
        xv: (Math.random()-0.5)*2.0*5.0,  // x velocity
        yv: (Math.random()-0.5)*2.0*5.0,  // y velocity
        age: 0,
      });
    };
    function drawMeteorBoom(){
      var frame = mtick % 16; //7 is the number of frames in the sprite sheet
      var x3 = frame * 64; //48 is the width of each frame
      c.drawImage(
        explosion_image, // the image of the sprite sheet
        x3,0,64,62, // source coords inside sheet (x,y,w,h)
        (x-32),(y-31),64,62 // destination coordinates on canvas (x,y,w,h)
      );
      mtick++;
    };
    var intervalMeteorBoom = setInterval(drawMeteorBoom,1000/30);
    setTimeout(function() { clearInterval(intervalMeteorBoom)}, 480);
  };
};

function doSetup() {
	attachEvent(document, "keydown", function(e) {
		keyboard[e.keyCode] = true;
	});
	attachEvent(document, "keyup", function(e) {
		keyboard[e.keyCode] = false;
	});
};

function attachEvent(node,name,func) {
    if(node.addEventListener) {
        node.addEventListener(name,func,false);
    } else if(node.attachEvent) {
        node.attachEvent(name,func);
    }
};

var mouse = {
    pos: {},
    down: false
};
 
canvas.addEventListener("click", function(){
    mouse.down = true;
}, false);
 
canvas.addEventListener("mousemove", function(evt){
    var pos = getMousePos(canvas, evt);
    mouse.pos.x = pos.x;
    mouse.pos.y = pos.y;
});
 
canvas.addEventListener("mouseout", function(evt){
    mouse.pos = {};
});

function drawScore(c) {
  
  c.save();
  c.fillStyle = "rgb(255,255,255)";
  c.font = "14pt Arial";
  c.fillText(overlay2.scoreTitle, 940,730);
  c.font = "14pt Arial";
  c.fillText(overlay2.score, 970,750);
  c.restore();
};

function drawOverlay(c) {
  if(overlay.counter == -1) return;
    
  var alpha = overlay.counter/50.0;
  if(alpha > 1) alpha = 1;
    
  c.save();
  c.fillStyle = "rgba(255,255,255,"+alpha+")";
  c.font = "Bold 40pt Michroma";
  c.fillText(overlay.title,280,60);
  c.font = "14pt Michroma";
  c.fillText(overlay.subtitle, 360,110);
  c.font = "14pt Michroma";
  c.fillText(overlay.scoreTitle, 415,160);
  c.font = "14pt Michroma";
  c.fillText(overlay.score, 535,160);
  c.restore();
};


doSetup();
setInterval(mainLoop,1000/30);

</script>
<audio autoplay="autoplay" loop>  
    <source src="sound/bg.wav" />   
</audio>
  </body>
</html>