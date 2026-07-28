// Navigation toggle for small screens
document.addEventListener('DOMContentLoaded', function(){
  var nav = document.getElementById('nav');
  var btn = document.getElementById('nav-toggle');
  if(btn && nav){
    btn.addEventListener('click', function(){
      if(nav.style.display === 'block') nav.style.display = '';
      else nav.style.display = 'block';
    });
  }

  // Basic client-side validation for contact form
  var form = document.getElementById('contactForm');
  if(form){
    form.addEventListener('submit', function(e){
      var name = form.querySelector('input[name="name"]').value.trim();
      var email = form.querySelector('input[name="email"]').value.trim();
      var msg = form.querySelector('textarea[name="message"]').value.trim();
      if(!name || !email || !msg){
        e.preventDefault();
        alert('Please fill all fields before sending.');
      }
    });
  }
});
