





const Events = () => {
    const accountIcon = document.getElementById('account-button');
    const accountTray = document.getElementById('account-container');

    accountIcon.addEventListener('click', () => {
        accountTray.classList.toggle('maximized');
});
};

Events();



const initialisePageEvents = () => {
    const notificationIcon = document.getElementById('notification-button');
    const notificationTray = document.getElementById('notification-container');

notificationIcon.addEventListener('click', () => {
    notificationTray.classList.toggle('maximized');
});
};

initialisePageEvents();



const notRegistered = () => {
    const notRegisteredIcon = document.getElementById('account-button');
    const notRegisteredTray = document.getElementById('not-registered-container');

    notRegisteredIcon.addEventListener('click', () => {
        notRegisteredTray.classList.toggle('maximized');
});
};

notRegistered();







//Popup

jQuery(document).ready(function($){
	//open popup
	$('.popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.popup').addClass('is-visible');
	});


    $('.popup').on('click', function(event){
		if( $(event.target).is('.popup-close') || $(event.target).is('.popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.popup').removeClass('is-visible');
	    }
    });
});

  //Popup




  //Pop

jQuery(document).ready(function($){
	//open popup
	$('.pop-trigger').on('click', function(event){
		event.preventDefault();
		$('.pop').addClass('e-visible');
	});


    $('.pop').on('click', function(event){
		if( $(event.target).is('.pop-close') || $(event.target).is('.pop') ) {
			event.preventDefault();
			$(this).removeClass('e-visible');
		}
	});
	
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.pop').removeClass('e-visible');
	    }
    });
});

  //Pop




    //Up

jQuery(document).ready(function($){
	//open popup
	$('.up-trigger').on('click', function(event){
		event.preventDefault();
		$('.up').addClass('visible');
	});


    $('.up').on('click', function(event){
		if( $(event.target).is('.up-close') || $(event.target).is('.up') ) {
			event.preventDefault();
			$(this).removeClass('visible');
		}
	});
	
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.up').removeClass('visible');
	    }
    });
});

  //Up


  //Up

jQuery(document).ready(function($){
	//open popup
	$('.ip-trigger').on('click', function(event){
		event.preventDefault();
		$('.ip').addClass('visible');
	});


    $('.ip').on('click', function(event){
		if( $(event.target).is('.ip-close') || $(event.target).is('.ip') ) {
			event.preventDefault();
			$(this).removeClass('visible');
		}
	});
	
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.ip').removeClass('visible');
	    }
    });
});

  //Up




  //Dropdown


  function dropDown() {
	var dropdownElement = $('.dropdown-element');
	var iconElement = document.getElementById("icon");
	var textElement = document.getElementById("text");
	var triangleElement = document.getElementById("triangle");
	var sideNav = document.getElementById("side-nav");
	
	if (dropdownElement.is(':visible')) {
	  dropdownElement.slideUp(255);
	  iconElement.style.color = '';
	  textElement.style.color = '';
	  triangleElement.style.color = '';
	  triangleElement.style.transform = '';
	  sideNav.style.height = '';
	  sideNav.style.position = '';
	} 
	else {
	  dropdownElement.slideDown(255);
	  iconElement.style.color = '#598DE0';
	  textElement.style.color = '#fff';
	  triangleElement.style.color = '#fff';
	  triangleElement.style.transform = 'rotate(180deg)';
	  sideNav.style.height = '1000px';

	}
  }




  function dropDownSecond() {
	var dropdownElementSecond = $('.dropdown-element-second');
	var textElementSecond = document.getElementById("text-second");
	var triangleElementSecond = document.getElementById("triangle-second");
	var sideNav = document.getElementById("side-nav");
	
	if (dropdownElementSecond.is(':visible')) {
	  dropdownElementSecond.slideUp(255);
	  textElementSecond.style.color = '';
	  triangleElementSecond.style.color = '';
	  triangleElementSecond.style.transform = '';
	  sideNav.style.height = '';

	} 
	else {
	  dropdownElementSecond.slideDown(255);
	  textElementSecond.style.color = '#fff';
	  triangleElementSecond.style.color = '#fff';
	  triangleElementSecond.style.transform = 'rotate(180deg)';
	  sideNav.style.height = '1600px';

	}
  }


  function dropDownThird() {
	var dropdownElementThird = $('.dropdown-element-third');
	var textElementThird = document.getElementById("text-third");
	var triangleElementThird = document.getElementById("triangle-third");
	var sideNav = document.getElementById("side-nav");

	if (dropdownElementThird.is(':visible')) {
	  dropdownElementThird.slideUp(255);
	  textElementThird.style.color = '';
	  triangleElementThird.style.color = '';
	  triangleElementThird.style.transform = '';

	} 
	else {
	  dropdownElementThird.slideDown(255);
	  textElementThird.style.color = '#fff';
	  triangleElementThird.style.color = '#fff';
	  triangleElementThird.style.transform = 'rotate(180deg)';

	}
  }



  function dropDownFourth() {
	var dropdownElementFourth = $('.dropdown-element-fourth');
	var textElementFourth = document.getElementById("text-fourth");
	var triangleElementFourth = document.getElementById("triangle-fourth");
	var sideNav = document.getElementById("side-nav");
	
	if (dropdownElementFourth.is(':visible')) {
	  dropdownElementFourth.slideUp(255);
	  textElementFourth.style.color = '';
	  triangleElementFourth.style.color = '';
	  triangleElementFourth.style.transform = '';
	  sideNav.style.height = '1200px';


	} 
	else {
	  dropdownElementFourth.slideDown(255);
	  textElementFourth.style.color = '#fff';
	  triangleElementFourth.style.color = '#fff';
	  triangleElementFourth.style.transform = 'rotate(180deg)';
	  sideNav.style.height = '1600px';

	}
  }



  function dropDownFifth() {
	var dropdownElementFifth = $('.dropdown-element-fifth');
	var textElementFifth = document.getElementById("text-fifth");
	var triangleElementFifth = document.getElementById("triangle-fifth");
	var sideNav = document.getElementById("side-nav");

	if (dropdownElementFifth.is(':visible')) {
	  dropdownElementFifth.slideUp(255);
	  textElementFifth.style.color = '';
	  triangleElementFifth.style.color = '';
	  triangleElementFifth.style.transform = '';

	} 
	else {
	  dropdownElementFifth.slideDown(255);
	  textElementFifth.style.color = '#fff';
	  triangleElementFifth.style.color = '#fff';
	  triangleElementFifth.style.transform = 'rotate(180deg)';

	}
  }



  function dropDownSixth() {
	var dropdownElementSixth = $('.dropdown-element-sixth');
	var textElementSixth = document.getElementById("text-sixth");
	var triangleElementSixth = document.getElementById("triangle-sixth");
	var sideNav = document.getElementById("side-nav");

	if (dropdownElementSixth.is(':visible')) {
	  dropdownElementSixth.slideUp(255);
	  textElementSixth.style.color = '';
	  triangleElementSixth.style.color = '';
	  triangleElementSixth.style.transform = '';
	  sideNav.style.height = '1200';

	} 
	else {
	  dropdownElementSixth.slideDown(255);
	  textElementSixth.style.color = '#fff';
	  triangleElementSixth.style.color = '#fff';
	  triangleElementSixth.style.transform = 'rotate(180deg)';
	  sideNav.style.height = '1600px';

	}
  }
  

  //Dropdown



  
  //NavBar



  

  function dropdown() {
	var dropdownTrigger = document.getElementById("dropdown");
	var dropdownTriangle = document.getElementById("dropdown-triangle");
	var ddDown = $('.ddown-menu');
	
	// Check if the ddDown element is visible
	if (ddDown.is(':visible')) {
	  // If visible, hide it and update dropdown styles
	  ddDown.hide();

	  dropdownTrigger.style.color = '';
	  dropdownTriangle.style.color = '';
	  dropdownTriangle.style.transform = '';
	} else {
	  // If hidden, show it and update dropdown styles
	  ddDown.show();
	  dropdownTrigger.style.color = '#fff';
	  dropdownTriangle.style.color = '#fff';
	  dropdownTriangle.style.transform = 'rotate(180deg)';
	}
  }
  
  


  function dropdownSecond() {
	var dropdownTrigger = document.getElementById("dropdown-second");
	var dropdownTriangle = document.getElementById("dropdown-triangle-second");
	var ddDown = $('.dpdown-menu');
	
	// Check if the ddDown element is visible
	if (ddDown.is(':visible')) {
	  // If visible, hide it and update dropdown styles
	  ddDown.hide();

	  dropdownTrigger.style.color = '';
	  dropdownTriangle.style.color = '';
	  dropdownTriangle.style.transform = '';
	} else {
	  // If hidden, show it and update dropdown styles
	  ddDown.show();
	  dropdownTrigger.style.color = '#fff';
	  dropdownTriangle.style.color = '#fff';
	  dropdownTriangle.style.transform = 'rotate(180deg)';
	}
  }
  
  

  //NavBar




//Slider

  var swiper = new Swiper('.blog-slider', {
	spaceBetween: 30,
	effect: 'fade',
	loop: true,
	mousewheel: {
	  invert: false,
	},
	// autoHeight: true,
	pagination: {
	  el: '.blog-slider__pagination',
	  clickable: true,
	}
  });

//Slider





//dashboard

function drop() {
	var text = document.getElementById("text");
	var triangle = document.getElementById("triangle");
	var down = $('.analytics-list-item-hidden');
	
	// Check if the ddDown element is visible
	if (down.is(':visible')) {
	  // If visible, hide it and update dropdown styles
	  down.hide();
	  text.style.color = '';
	  triangle.style.color = '';
	  triangle.style.transform = '';
	} else {
	  // If hidden, show it and update dropdown styles
	  down.show();
	  text.style.color = '#fff';
	  triangle.style.color = '#fff';
	  triangle.style.transform = 'rotate(180deg)';
	}
  }


  function dropSecond() {
	var textSecond = document.getElementById("text-second");
	var triangleSecond = document.getElementById("triangle-second");
	var downSecond = $('.analytics-list-item-hidden-second');
	
	// Check if the ddDown element is visible
	if (downSecond.is(':visible')) {
	  // If visible, hide it and update dropdown styles
	  downSecond.hide();
	  textSecond.style.color = '';
	  triangleSecond.style.color = '';
	  triangleSecond.style.transform = '';
	} else {
	  // If hidden, show it and update dropdown styles
	  downSecond.show();
	  textSecond.style.color = '#fff';
	  triangleSecond.style.color = '#fff';
	  triangleSecond.style.transform = 'rotate(180deg)';
	}
  }



//dashboard






//discussion

function dropyDown() {
	var dropydownElement = $('.dropydown-element');
	var textyElement = document.getElementById("texty");
	var trianglyElement = document.getElementById("triangly");
	
	if (dropydownElement.is(':visible')) {
	  dropydownElement.slideUp(255);
	  textyElement.style.color = '';
	  trianglyElement.style.color = '';
	  trianglyElement.style.transform = '';
	} 
	else {
	  dropydownElement.slideDown(255);
	  textyElement.style.color = '#fff';
	  trianglyElement.style.color = '#fff';
	  trianglyElement.style.transform = 'rotate(180deg)';
	}
  }






//chart

const ctx = document.getElementById('views');
              
new Chart(ctx, {
  type: 'bar',
  data: {
	labels: ['Mar', 'Apr', 'May'],

	datasets: [{
	  data: [400, 150, 200],
	  borderWidth: 2,
      borderRadius: 20,
	  backgroundColor: '#2351F4',
	  hoverBorderColor: '#fff',
	  minBarWidth: '180px',
	  barThickness: 100,
	}]
  },
  options: {
	responsive: true,



	plugins: {
		legend: {
		  display: false,
		},
		title: {
		  display: true,
		  text: 'Views',
		  color: '#fff',
		  align: 'start',
		  font: {
			family: 'Public Sans, sans-serif',
			style: 'normal',
			weight: '600',
			size: '20px',
		  },

		  padding: 30,

		},

	},
	scales: {
	  y: {
		beginAtZero: true,
		border: {
			color: '#676B70',
			display: false,
			
		},
		grid: {
			color: '#676B70',
			lineWidth: 1,

		},
		ticks: {
			max: 25000,
			min: 0,
			stepSize: 100,
			beginAtZero: true,
			padding: 20,
		}
	  },
	  x:{
		grid:{
			display: false,
		},



	  }
	}
  }
});









const ct = document.getElementById('downloads');
              
new Chart(ct, {
  type: 'bar',
  data: {
	labels: ['Mar', 'Apr', 'May'],

	datasets: [{
	  data: [12, 34, 52],
	  borderWidth: 2,
      borderRadius: 20,
	  backgroundColor: '#1CC52D',
	  hoverBorderColor: '#fff',
	  minBarWidth: '180px',
	  barThickness: 100,
	}]
  },
  options: {
	responsive: true,



	plugins: {
		legend: {
		  display: false,
		},
		title: {
		  display: true,
		  text: 'Downloads',
		  color: '#fff',
		  align: 'start',
		  font: {
			family: 'Public Sans, sans-serif',
			style: 'normal',
			weight: '600',
			size: '20px',
		  },

		  padding: 30,

		},

	},
	scales: {
	  y: {
		beginAtZero: true,
		border: {
			color: '#676B70',
			display: false,
			
		},
		grid: {
			color: '#676B70',
			lineWidth: 1,

		},
		ticks: {
			max: 25000,
			min: 0,
			stepSize: 10,
			beginAtZero: true,
			padding: 20,
		}
	  },
	  x:{
		grid:{
			display: false,
		},


	  }
	}
  }
});





//chart