(function(){
  'use strict';
  document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.needs-validation').forEach(function(form){
      form.addEventListener('submit', function (event) {
        const ok = validateImageFile(form);
        if (!form.checkValidity() || !ok){
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });

    function validateImageFile(scope){
      const form = scope || document;
      const input = form.querySelector('#image');
      if (!input) return true;
      const file = input.files && input.files[0];
      const feedback = form.querySelector('#image-feedback');
      const allowed = /\.(jpe?g|png|gif|webp)$/i;
      input.setCustomValidity('');
      if (!file){ return false; }
      const name = file.name || '';
      if (!allowed.test(name)){
        input.setCustomValidity('Invalid file type');
        if (feedback){ feedback.textContent = 'Invalid file type. Allowed: jpg, jpeg, png, gif, webp.'; }
        return false;
      }
      return true;
    }

    const imageInput = document.querySelector('#image');
    if (imageInput){
      imageInput.addEventListener('change', function(){
        const form = imageInput.closest('form'); if (form){ form.checkValidity(); }
      });
    }

    const modalEl = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');
    if (modalEl && modalImg){
      const modal = new bootstrap.Modal(modalEl);
      document.querySelectorAll('.gallery-img, #detailThumb').forEach(function(img){
        img.addEventListener('click', function(e){
          if (img.classList.contains('gallery-img')){ e.preventDefault(); }
          const full = img.getAttribute('data-full') || img.getAttribute('src');
          modalImg.src = full;
          if (modalCaption){ modalCaption.textContent = img.alt || ''; }
          modal.show();
        });
      });
    }
  });
})();