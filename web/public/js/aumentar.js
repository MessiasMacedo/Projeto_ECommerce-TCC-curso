
        document.querySelectorAll('.btn-plus').forEach((btn) => {
            btn.addEventListener('click', function () {
                const input = this.parentNode.querySelector('.qty-input');
                input.value = parseInt(input.value) + 1;
            });
        });

        document.querySelectorAll('.btn-minus').forEach((btn) => {
            btn.addEventListener('click', function () {
                const input = this.parentNode.querySelector('.qty-input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
