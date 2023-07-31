/**
     * Validate Update Form
     */
function validateForm(form){
  let formValidate = document.getElementById(form);
  let elementsForm = formValidate.elements;
  let validar = 0, inputs = 0;
  for(let c=0; c<elementsForm.length; c++){
    let idElement = elementsForm[c].id;
    if((elementsForm[c].tagName == 'INPUT' || elementsForm[c].tagName == 'SELECT') && document.getElementById(`ms${idElement}`)){
      inputs++
      !elementsForm[c].value ? (
        document.getElementById(`ms${idElement}`).classList.remove('d-none')
      ) : (
        document.getElementById(`ms${idElement}`).classList.add('d-none'),
        validar++
      );  
    }
  }
  if(validar==inputs){
    if(form == 'crearForm'){
      formValidate.submit();
    }else{
      updateConfir(formValidate);
    }  
  }
}

/**
  * Confir Delete
 */
$(document).on('click', '.delete', function(){
  let element = $(this)[0];
  let form = element.parentNode;
  Swal.fire({
    title: 'Estas seguro de eliminar este registro?',
    showCancelButton: true,
    confirmButtonText: 'Acceptar',
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit()
    }
  });
});

/**
  * Confir Update
*/
function updateConfir(form){
  Swal.fire({
    title: 'Estas seguro de editar la información de este registro?',
    showCancelButton: true,
    confirmButtonText: 'Acceptar',
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit()
    }
  });
}

/**
  * Buscar Instructor
*/
$(document).on('keyup', '.instructor', function(){
  let input = $(this)[0].id;
  let selectInstructor = document.getElementById(`id_${input}`);
  let form = document.getElementsByClassName(`prestamoForm${input.substring(10,11)}`);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", '/instructoresList');
    xhr.send(new FormData(form[0]));
    xhr.onload = function (e) {
      let instructoresList = JSON.parse(xhr.responseText);
      let option = '<option selected disabled value="">Seleccionar Opción...</option>';
      if(instructoresList.length){
        selectInstructor.classList.remove('d-none');
        instructoresList.forEach(instructor => {
          option += `<option value="${instructor.name}">${instructor.name}</option>`;
        });
        selectInstructor.innerHTML = option;
      }else{
        selectInstructor.classList.add('d-none');
      }
  }
});

$(document).on('change', '.select', function(){
  let select = $(this)[0];
  let selectId = $(this)[0].id;
  let input = document.getElementById(selectId.substring(3,14));
  let instructor = select.options[select.selectedIndex].text;
  input.value = instructor;
  select.classList.add('d-none');
});

/**
  * Buscar Ambiente
*/
$(document).on('keyup', '.ambiente', function(){
  let input = $(this)[0].id;
  let selectAmbiente = document.getElementById(`id_${input}`);
  let form = document.getElementsByClassName(`prestamoForm${input.substring(10,11)}`);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", '/ambientesList');
    xhr.send(new FormData(form[0]));
    xhr.onload = function (e) {
      let ambientesList = JSON.parse(xhr.responseText);
      let option = '<option selected disabled value="">Seleccionar Opción...</option>';
      if(ambientesList.length){
        selectAmbiente.classList.remove('d-none');
        ambientesList.forEach(ambiente => {
          option += `<option value="${ambiente.id}">${ambiente.ambiente}</option>`;
        });
        selectAmbiente.innerHTML = option;
      }else{
        selectAmbiente.classList.add('d-none');
      }
  }
});

$(document).on('change', '.selectAmbiente', function(){
  let select = $(this)[0];
  let selectId = $(this)[0].id;
  let input = document.getElementById(selectId.substring(3,13));
  let ambiente = select.options[select.selectedIndex].text;
  input.value = ambiente;
  select.classList.add('d-none');
});

/**
  * Change Estado
 */
function cambiarEstado(estadoId){
  Swal.fire({
    title: 'Las llaves han sido devueltas por el instructor?',
    showCancelButton: true,
    confirmButtonText: 'Si',
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = `/prestamos/${estadoId}`;
    }
  });
}

/**
  * Solicitar Entrega
 */
function solicitarEntrega(estadoId){
  Swal.fire({
    title: 'Ya terminastes tus actividades y quieres entregar las llaves?',
    showCancelButton: true,
    confirmButtonText: 'Si',
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = `/entregas/${estadoId}`;
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
    "use strict";
  
    /**
     * Preloader
     */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
      window.addEventListener('load', () => {
        preloader.remove();
      });
    }
  
    /**
     * Sticky Header on Scroll
     */
    const selectHeader = document.querySelector('#header');
    if (selectHeader) {
      let headerOffset = selectHeader.offsetTop;
      let nextElement = selectHeader.nextElementSibling;
  
      const headerFixed = () => {
        if ((headerOffset - window.scrollY) <= 0) {
          selectHeader.classList.add('sticked');
          if (nextElement) nextElement.classList.add('sticked-header-offset');
        } else {
          selectHeader.classList.remove('sticked');
          if (nextElement) nextElement.classList.remove('sticked-header-offset');
        }
      }
      window.addEventListener('load', headerFixed);
      document.addEventListener('scroll', headerFixed);
    }
  
    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = document.querySelectorAll('#navbar a');
  
    function navbarlinksActive() {
      navbarlinks.forEach(navbarlink => {
  
        if (!navbarlink.hash) return;
  
        let section = document.querySelector(navbarlink.hash);
        if (!section) return;
  
        let position = window.scrollY + 200;
  
        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
          navbarlink.classList.add('active');
        } else {
          navbarlink.classList.remove('active');
        }
      })
    }
    window.addEventListener('load', navbarlinksActive);
    document.addEventListener('scroll', navbarlinksActive);
  
    /**
     * Mobile nav toggle
     */
    const mobileNavShow = document.querySelector('.mobile-nav-show');
    const mobileNavHide = document.querySelector('.mobile-nav-hide');
  
    document.querySelectorAll('.mobile-nav-toggle').forEach(el => {
      el.addEventListener('click', function(event) {
        event.preventDefault();
        mobileNavToogle();
      })
    });
  
    function mobileNavToogle() {
      document.querySelector('body').classList.toggle('mobile-nav-active');
      mobileNavShow.classList.toggle('d-none');
      mobileNavHide.classList.toggle('d-none');
    }
  
    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll('#navbar a').forEach(navbarlink => {
  
      if (!navbarlink.hash) return;
  
      let section = document.querySelector(navbarlink.hash);
      if (!section) return;
  
      navbarlink.addEventListener('click', () => {
        if (document.querySelector('.mobile-nav-active')) {
          mobileNavToogle();
        }
      });
  
    });
  
    /**
     * Toggle mobile nav dropdowns
     */
    const navDropdowns = document.querySelectorAll('.navbar .dropdown > a');
  
    navDropdowns.forEach(el => {
      el.addEventListener('click', function(event) {
        if (document.querySelector('.mobile-nav-active')) {
          event.preventDefault();
          this.classList.toggle('active');
          this.nextElementSibling.classList.toggle('dropdown-active');
  
          let dropDownIndicator = this.querySelector('.dropdown-indicator');
          dropDownIndicator.classList.toggle('bi-chevron-up');
          dropDownIndicator.classList.toggle('bi-chevron-down');
        }
      })
    });
  
    /**
     * UPPER KEYUP 
    */
    const inputs = document.getElementsByTagName('input');
    const mayuscula = function(e){
      e.value = e.value.toUpperCase();
    }
    for(let i=1; i<inputs.length; i++){
      if(inputs[i].getAttribute('type')=='text' && inputs[i].id !== 'password'){
        let id = inputs[i].getAttribute('id');
        let input = document.getElementById(id);
        inputs[i].onkeyup = function(){
          mayuscula(input);
        }
      }
    }

    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector('.scroll-top');
    if (scrollTop) {
      const togglescrollTop = function() {
        window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
      }
      window.addEventListener('load', togglescrollTop);
      document.addEventListener('scroll', togglescrollTop);
      scrollTop.addEventListener('click', window.scrollTo({
        top: 0,
        behavior: 'smooth'
      }));
    }
  
    /**
     * Clients Slider
     */
    // new Swiper('.clients-slider', {
    //   speed: 400,
    //   loop: true,
    //   autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false
    //   },
    //   slidesPerView: 'auto',
    //   pagination: {
    //     el: '.swiper-pagination',
    //     type: 'bullets',
    //     clickable: true
    //   },
    //   breakpoints: {
    //     320: {
    //       slidesPerView: 2,
    //       spaceBetween: 40
    //     },
    //     480: {
    //       slidesPerView: 3,
    //       spaceBetween: 60
    //     },
    //     640: {
    //       slidesPerView: 4,
    //       spaceBetween: 80
    //     },
    //     992: {
    //       slidesPerView: 6,
    //       spaceBetween: 120
    //     }
    //   }
    // });
  
    // /**
    //  * Init swiper slider with 1 slide at once in desktop view
    //  */
    // new Swiper('.slides-1', {
    //   speed: 600,
    //   loop: true,
    //   autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false
    //   },
    //   slidesPerView: 'auto',
    //   pagination: {
    //     el: '.swiper-pagination',
    //     type: 'bullets',
    //     clickable: true
    //   },
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   }
    // });
  
    // /**
    //  * Init swiper slider with 3 slides at once in desktop view
    //  */
    // new Swiper('.slides-3', {
    //   speed: 600,
    //   loop: true,
    //   autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false
    //   },
    //   slidesPerView: 'auto',
    //   pagination: {
    //     el: '.swiper-pagination',
    //     type: 'bullets',
    //     clickable: true
    //   },
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   },
    //   breakpoints: {
    //     320: {
    //       slidesPerView: 1,
    //       spaceBetween: 40
    //     },
  
    //     1200: {
    //       slidesPerView: 3,
    //     }
    //   }
    // });
  
    // /**
    //  * Porfolio isotope and filter
    //  */
    // let portfolionIsotope = document.querySelector('.portfolio-isotope');
  
    // if (portfolionIsotope) {
  
    //   let portfolioFilter = portfolionIsotope.getAttribute('data-portfolio-filter') ? portfolionIsotope.getAttribute('data-portfolio-filter') : '*';
    //   let portfolioLayout = portfolionIsotope.getAttribute('data-portfolio-layout') ? portfolionIsotope.getAttribute('data-portfolio-layout') : 'masonry';
    //   let portfolioSort = portfolionIsotope.getAttribute('data-portfolio-sort') ? portfolionIsotope.getAttribute('data-portfolio-sort') : 'original-order';
  
    //   window.addEventListener('load', () => {
    //     let portfolioIsotope = new Isotope(document.querySelector('.portfolio-container'), {
    //       itemSelector: '.portfolio-item',
    //       layoutMode: portfolioLayout,
    //       filter: portfolioFilter,
    //       sortBy: portfolioSort
    //     });
  
    //     let menuFilters = document.querySelectorAll('.portfolio-isotope .portfolio-flters li');
    //     menuFilters.forEach(function(el) {
    //       el.addEventListener('click', function() {
    //         document.querySelector('.portfolio-isotope .portfolio-flters .filter-active').classList.remove('filter-active');
    //         this.classList.add('filter-active');
    //         portfolioIsotope.arrange({
    //           filter: this.getAttribute('data-filter')
    //         });
    //         if (typeof aos_init === 'function') {
    //           aos_init();
    //         }
    //       }, false);
    //     });
  
    //   });
  
    // }
  
    /**
     * Animation on scroll function and init
     */
    // function aos_init() {
    //   AOS.init({
    //     duration: 1000,
    //     easing: 'ease-in-out',
    //     once: true,
    //     mirror: false
    //   });
    // }
    // window.addEventListener('load', () => {
    //   aos_init();
    // });
  
  });