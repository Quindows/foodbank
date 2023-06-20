window.addEventListener('scroll', function() {
    var scrollY = window.scrollY;

    if (window.scrollY > 80) {
        document.querySelector('header').classList.add('scroll');
        // document.getElementById('#logo').classList.add('small');
    } else {
        document.querySelector('header').classList.remove('scroll');
        // document.getElementById('#logo').classList.remove('small');
    }
});

window.addEventListener('resize', function() {
    var width = window.width;

    if(screen.width < 385) {
        this.document.querySelector('header').classList.add('collapse');
        this.document.querySelector('div#hamburger-menu').classList.remove('hide');
    } else {
        this.document.querySelector('header').classList.remove('collapse');
        this.document.querySelector('div#hamburger-menu').classList.add('hide')
    }
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  const sections = document.querySelectorAll("section[id]");
  window.addEventListener("scroll", navHighlighter);

  function navHighlighter() {
      let scrollY = window.pageYOffset;
      sections.forEach(current => {
          const sectionHeight = current.offsetHeight;
          const sectionTop = (current.getBoundingClientRect().top + window.pageYOffset) - 50;
          sectionId = current.getAttribute("id");
          if (
              scrollY > sectionTop &&
              scrollY <= sectionTop + sectionHeight
          ) {
              document.querySelector(".navigation a[href*=" + sectionId + "]").classList.add("active");
          } else {
              document.querySelector(".navigation a[href*=" + sectionId + "]").classList.remove("active");
          }
      });
  }