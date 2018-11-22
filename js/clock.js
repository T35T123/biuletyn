  (() => setInterval(function(){

      const t = new Date(Date.now());

      const [hour, minute, second] = document.querySelectorAll('.time-hours,.time-minutes,.time-seconds');

      let h = t.getHours();
      let m = t.getMinutes();
      let s = t.getSeconds();

      hour.innerText = `${h < 10 ? '0' + h : h}`;
      minute.innerText = `${m < 10 ? '0' + m : m}`;
      second.innerText = `${s < 10 ? '0' + s : s}`;

  }, 1000)
  )();