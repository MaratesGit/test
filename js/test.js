





// var loading = document.querySelector('progress');

// while (loading.value<=100){
	
// 	setInterval(function(){
// 		loading.value = loading.value+3;
		
// 	},1000);
// }
// group.showList();



// var req = new XMLHttpRequest();

// req.onreadystatechange = () => {
// 	if (req.readyState == 4 && req.status ==200){
// 		console.log(req.responseText);
// 	}
// }

// req.open('get','test.php');
// req.send();

// var elems = document.querySelectorAll('.section');
// elems.forEach(function(elem)  {
		
// 	elem.onclick = function() {
// 		this.classList.toggle('border');
// 	}

// });

// function test(){
// 	this.name = 'Mark';
// }

// test.prototype = {
// 	getName: function (){
// 		return(this.name);
// 	}
// }

// var obj = new test();
// console.log(obj);


// var c = {
// 	name:'mark',
// 	getName: () => {return this;}
// };
// var d = {
// 	getName: function(){return this;}
// }



// console.log(c.getName());
// console.log(d.getName());

let second_container = document.querySelector('.second-container');

let header = document.querySelector('header');
let linksContainer = document.querySelector('.links-container');
function display(){
	linksContainer.style.display = 'flex';
}
window.onscroll = function(){
	console.log(1)
	if (window.scrollY < 125){
		if(header.style.width !== '100%'){
			header.style.width = '100%';
			header.addEventListener('transitionend',display);
		}
	}
	if(window.scrollY>=125){
			header.removeEventListener('transitionend',display);
			linksContainer.style.display = 'none';
			header.style.width = '20%';
	}
	
	if(second_container.getBoundingClientRect().top<=300){
		document.querySelector('#change').style.opacity = '1';
	}
	else {
		document.querySelector('#change').style.opacity = '0';
	}

}

var t;
function up() {
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
  if(top > 0) {
    window.scrollBy(0,-60);
    t = setTimeout('up()',20);
  } else clearTimeout(t);
  return false;
}

document.querySelector('.header h1').onclick = function()
{
	up();
};



class Test {

	constructor(name){
		this.name = name;
	}
	getName(){
		return this.name;
	}
}

let user = {
	name:'Mark',
	getName: function(){
		console.log(this);
	}

};
let student = {
	name:'Kolya'
};

// setTimeout(user.getName.bind(user),2000);

function bind(func,context){
	return function (){
		return func.call(context);
	}
}




let a = new Test('Mark');


console.dir(a.getName());

// function CoffeeMachine(power) {
//   var waterAmount = 0;

//   var WATER_HEAT_CAPACITY = 4200;

//   function getTimeToBoil() {
//     return waterAmount * WATER_HEAT_CAPACITY * 80 / power;
//   }

//   this.run = function() {
//     setTimeout(function() {
//       alert( 'Кофе готов!' );
//     }, getTimeToBoil());
//   };

//   this.setWaterAmount = function(amount) {
//     waterAmount = amount;
//   };

// }

// var coffeeMachine = new CoffeeMachine(10000);
// coffeeMachine.setWaterAmount(50);
// coffeeMachine.run();

// function Coffee(power,name){
// 	this.waterAmount = 0;
// 	this.WATER_HEAT_CAPACITY = 4200;
// 	this.power = power;
// 	this.name = name;
// }

// Coffee.prototype = {
// 	getTimeToBoil:function(){
// 		return this.waterAmount * this.WATER_HEAT_CAPACITY * 80 / this.power;},
// 	run: function(){
// 	setTimeout(function(){
// 		alert('Кофе готов');
// 	},this.getTimeToBoil(this.power))},
// 	setWaterAmount: function(amount){
// 	this.waterAmount = amount;},
// 	getName: function(){
// 		console.log(this.name);
// 	}
// };


// var machine = new Coffee(10000,'BOSS');
// machine.setWaterAmount(50);
// machine.run();
// machine.getName();
// console.dir(machine);


// class CoffeeMachine {

// 	constructor(power,name){
// 		this._power = power;
// 		this._name = name;
// 		this.waterAmount = 0;
// 		this.WATER_HEAT_CAPACITY = 4200;
// 	}
	

// 	getTimeToBoil (){
// 		return this.waterAmount * this.WATER_HEAT_CAPACITY * 80 / this._power;
// 	}

// 	run(){
// 		setTimeout( () => {
// 			alert('Кофе готов');
// 		},
// 		this.getTimeToBoil() );
// 	}

// 	setWaterAmount(amount){
// 		this.waterAmount = amount;
// 	}

// 	getName(){
// 		console.log(this._name);
// 	}

// }


// var mac = new CoffeeMachine(10000,'BOSS');
// mac.setWaterAmount(50);
// mac.run();
// mac.getName();
// console.dir(mac);





