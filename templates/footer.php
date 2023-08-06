</main>
    <footer class="mt-5">
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script>
        const table = document.querySelector('#table-accounts');
        const tbody = document.querySelector('#tbody');
        const input = document.querySelector('#accountNumber');
        const movSection = document.querySelector('#movements-section');

        for (let i = 1; i < table.rows.length; i++) {
            table.rows[i].addEventListener('click', function() {
            const accountNumber = this.cells[0].textContent;
            const title = document.querySelector('#titleDetails');
            movSection.classList.remove('d-none');
            title.textContent = accountNumber;
            input.value = accountNumber;
            tbody.innerHTML = '';

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const data = JSON.parse(xmlhttp.responseText);
                    data.forEach((detail) => {
                        const newRow = tbody.insertRow();
                        newRow.insertCell().textContent = detail.id;
                        newRow.insertCell().textContent = detail.movement+detail.cant;
                    });
                }
            };
            xmlhttp.open("GET","details_ajax.php?accountNumber="+accountNumber,true);
            xmlhttp.send();
            });
        }
    </script>
    <script>
        function addMovement(event) {
            event.preventDefault();
            const form = document.getElementById('movement-form');
            const formData = new FormData(form);
            
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST', 'details_ajax.php', true);
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === XMLHttpRequest.DONE) {
                    if (xmlhttp.status === 200) {
                        const tbody = document.querySelector('#tbody');
                        tbody.innerHTML = '';
                        const data = JSON.parse(xmlhttp.responseText);
                        data.forEach((detail) => {
                            const newRow = tbody.insertRow();
                            newRow.insertCell().textContent = detail.id;
                            newRow.insertCell().textContent = detail.movement+detail.cant;
                        });
                    }
                }
            };

            xmlhttp.send(formData);
            form.movement.value = '0';
            form.cant.value = ''; 
        }
    </script>    
</body>
</html>