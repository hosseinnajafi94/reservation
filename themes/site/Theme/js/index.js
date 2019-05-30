//TIMESTAMP
(function() {
    setInterval(function() {
        var now, timestamp;
        timestamp = new Date(2014, 12, 06);
        now = new Date();
        return $('#time').text(((now - timestamp) / 1000).toFixed(0));
    }, 1000);
}).call(this);



//CANVAS

window.onload = function(){
	  
          
          $('#target-div').load('http://hostiran.net/iframe.htm');
		   var lastHeight=$("#asb").height();

	       
	
            var canvas = document.querySelector('canvas');
            ctx = canvas.getContext('2d');
        
			color = '#aaa';
			var check =respondCanvas();
			canvas.width = check[1];
			canvas.height =lastHeight;
			canvas.style.display = 'block';
			ctx.fillStyle = color;
			ctx.lineWidth = .1;
			ctx.strokeStyle = color;

        function respondCanvas(){
		var width = [];
	    width[0]= $('#smile').width(); //max width
        width[1]= $('canvas').width(); //max width
       
        return width;

        //Call a function to redraw other content (texts, images etc)
       }
	
	function checkheight(){
		 var height= $('#asb').height(); //max width
		 //console.log(height);
		// return height;
		}

    var mousePosition = {
        x: 30 * canvas.width / 100,
        y: 30 * canvas.height / 100
    };
	
	if(canvas.width<=1000)
	{
		var numdot=100;
	}
	else if(canvas.width<=800){
		var numdot=80;
	}
	else if(canvas.width<=500)
 	{
		var numdot=35;
	}
	else
	{
		var numdot=300;
    }
   
    var dots = {
        nb: numdot,
        distance: 70,
        d_radius: 50,
        array: []
    };

    function Dot(){
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;

        this.vx = -.5 + Math.random();
        this.vy = -.5 + Math.random();

        this.radius = Math.random();
    }

    Dot.prototype = {
        create: function(){
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
            ctx.fill();
        },

        animate: function(){
            for(i = 0; i < dots.nb; i++){

                var dot = dots.array[i];

                if(dot.y < 0 || dot.y > canvas.height){
                    dot.vx = dot.vx;
                    dot.vy = - dot.vy;
                }
                else if(dot.x < 0 || dot.x > canvas.width){
                    dot.vx = - dot.vx;
                    dot.vy = dot.vy;
                }
                dot.x += dot.vx;
                dot.y += dot.vy;
            }
        },

        line: function(){
            for(i = 0; i < dots.nb; i++){
                for(j = 0; j < dots.nb; j++){
                    i_dot = dots.array[i];
                    j_dot = dots.array[j];

                    if((i_dot.x - j_dot.x) < dots.distance && (i_dot.y - j_dot.y) < dots.distance && (i_dot.x - j_dot.x) > - dots.distance && (i_dot.y - j_dot.y) > - dots.distance){
                        if((i_dot.x - mousePosition.x) < dots.d_radius && (i_dot.y - mousePosition.y) < dots.d_radius && (i_dot.x - mousePosition.x) > - dots.d_radius && (i_dot.y - mousePosition.y) > - dots.d_radius){
                            ctx.beginPath();
                            ctx.moveTo(i_dot.x, i_dot.y);
                            ctx.lineTo(j_dot.x, j_dot.y);
                            ctx.stroke();
                            ctx.closePath();
                        }
                    }
                }
            }
        }
    };

    function createDots(){
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for(i = 0; i < dots.nb; i++){
            dots.array.push(new Dot());
            dot = dots.array[i];

            dot.create();
        }

        dot.line();
        dot.animate();
    }
    
    $("canvas").mousemove(function(parameter){
        
        mousePosition.x = parameter.pageX-0;
        mousePosition.y = parameter.pageY-300;
    });

    setInterval(createDots, 1000/30);
};