  
  const slides = [...$('#newses>article')];
  let height = $('main').height();

  if($(slides[slides.length - 1]).height() < height) slides.pop();

  let jumps = [];

  let currentJump = 0;
  let offset = 0;
  let speed = 1000; //miliseconds

  const calculateJumps = () => {
    slides.forEach(n => {

      const nodeHeight = $(n).height();

      if(nodeHeight < height){
        
        jumps.push(height);
        $(n).css('height', `100vh`);

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

  $('#newses').on('transitionend', function(){

     if(currentJump == jumps.length){
       currentJump = -1;
       offset = 0;
       $(this).css('transform', `translate(0px, ${offset}px)`);
       $(this).css('transition', `transform ${1}ms ease 0s`);
       $('#newses>article:nth-child(0)').css('order', '2');
     }else{
       offset -= jumps[currentJump];
       $(this).css('transform', `translate(0px, ${offset}px)`);
       $(this).css('transition', `transform ${speed}ms ease 0s`);
     }

    ++currentJump;

  });

  $(window).resize(function(){
    calculateJumps();
  });

  calculateJumps();

  $('#newses').css('transition', `transform ${speed}ms ease 0s`);
  $('#newses').css('transform', 'translate(0px, 0px)');


  console.log(jumps);
