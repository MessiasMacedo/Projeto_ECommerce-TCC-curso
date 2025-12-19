    document.querySelectorAll('.accordion-button').forEach(btn => {
      btn.addEventListener('click', function() {
        const target = document.querySelector(this.dataset.bsTarget);

        if (target.classList.contains('show')) {
          const collapse = bootstrap.Collapse.getInstance(target);
          collapse.hide();
        }
      });
    });