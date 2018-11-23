

  let jumps;

  let currentJump;
  let offset;
  let speed = 2000; //miliseconds

  const calculateJumps = () => {

      
    const slides = [...$('#newses>article')];
    let height = $('main').height();

    if($(slides[slides.length - 1]).height() < height) slides.pop();
    slides.pop();

    jumps = [];
    currentJump = 0;
    offset = 0;

    slides.forEach(n => {

      const nodeHeight = $(n).height();

      if(nodeHeight < height+10){
        
        jumps.push(height);
        //$(n).css('height', `100vh`);

      }

      else {

        const parts = Math.ceil(nodeHeight / height);

        for(let i=0; i<parts; i++){
          jumps.push(height);
        }

        $(n).css('height', `${height*parts}px`);

      }

    });
  }

  const initSliding = () => {

    $('#newses').css('transition', `transform ${speed}ms ease 0s`);
    $('#newses').css('transform', 'translate(0px, 0px)');

  }

  const stopSliding = () => {

    $("#newses").css('transform', 'none');
    $("#newses").css('transition', 'none');

  }

  $('#newses').on('transitionend', function(){

     if(currentJump == jumps.length){
       currentJump = -1;
       offset = 0;
       $(this).css('transform', `translate(0px, ${offset}px)`);
       $(this).css('transition', `transform ${1}ms ease 0s`);
     }else{
       offset -= jumps[currentJump];
       $(this).css('transform', `translate(0px, ${offset}px)`);
       $(this).css('transition', `transform ${speed}ms ease 0s`);
     }

    ++currentJump;

  });

  $(window).resize(function(){

    stopSliding();

    calculateJumps();

//    $("#newses").css('transform', 'translate(0px, 0px)');

    initSliding();
  
  });

  calculateJumps();
  initSliding();


  console.log(jumps);
