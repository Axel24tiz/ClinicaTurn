const apiUrl = 'http://localhost/ClinicaTurn/ClinicaKrause/apiProfesionales.php'; // Asegúrate de que esta URL sea correcta

document.addEventListener('DOMContentLoaded', () => {
    fetchTasks();
    fetchEstados(); // Cargar los estados al inicio
});

async function fetchTasks() {
    try {
        const response = await fetch(apiUrl);
        const tasks = await response.json();
        const tasksList = document.getElementById('tasks');
        tasksList.innerHTML = '';

        tasks.forEach(task => {
            const li = document.createElement('li');
            li.classList.add(task.status);
            li.innerHTML = `
            
            <span>
                ${task.apellido} ${task.nombre}
            </span>
            <div class="button-group">
                    <button class="edit" onclick="loadTask(${task.id_medico})">Editar</button>
                    <button class="delete" onclick="deleteTask(${task.id_medico})">Eliminar</button>
                </div>
                
            `;
            tasksList.appendChild(li);
        });
    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
}

async function fetchEstados() {
    try {
        const response = await fetch(`${apiUrl}/estados`);
       
        const estados = await response.json();
        const statusSelect = document.getElementById('status');
        
        estados.forEach(estado => {//alert(estado.nombre);
            const option = document.createElement('option');
            option.value = estado.id;
            option.textContent = estado.nombre;
            statusSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching estados:', error);
    }
}

function loadTask(id) {
    fetch(`${apiUrl}/${id}`)
        .then(response => response.json())
        .then(task => {
            document.getElementById('form_id').value = task.id_medico;
            
            document.getElementById('form_apellido').value = task.apellido;
            document.getElementById('form_nombre').value = task.nombre;
            document.getElementById('form_especialidad').value = task.id_especialidad;
        })
        .catch(error => console.error('Error loading profesional:', error));
}

async function saveTask() {
    const id = document.getElementById('form_id').value;
    
    const apellido = document.getElementById('form_apellido').value.trim();
    const nombre = document.getElementById('form_nombre').value.trim();
    const especialidad = document.getElementById('form_especialidad').value.trim();

    // Validación de campos vacíos
    if (!apellido || !nombre) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El Apellido y el Nombre no pueden estar vacíos.',
        });
        return;
    }

    const taskData = {
        
        apellido,
        nombre,
        especialidad
    };

    try {
        let response;
        if (id) {
            // Update task
            response = await fetch(`${apiUrl}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(taskData)
            });
        } else {
            // Create new task
            response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(taskData)
            });
        }

        const result = await response.json();
        console.log('Task saved:', result);
        fetchTasks(); // Refresh task list
        clearForm();

        // Show success message
        if (id) {
            Swal.fire({
                icon: 'success',
                title: '¡Datos actualizado!',
                text: `-"${apellido} ${nombre}"\n ha sido actualizado exitosamente.`,
                timer: 3000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: '¡Profesional Agregado!',
                text: `-"${apellido} ${nombre}"\n ha sido agregado exitosamente.`,
                timer: 3000,
                showConfirmButton: false
            });
        }
    } catch (error) {
        console.error('Error saving task:', error);
    }
}

async function deleteTask(id) {
    try {
        // Fetch the task details before deleting
        const response = await fetch(`${apiUrl}/${id}`);
        const task = await response.json();
        
        // Show SweetAlert2 confirmation
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: `¿Quieres borrar al "${task.apellido} ${task.nombre}"`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            const deleteResponse = await fetch(`${apiUrl}/${id}`, {
                method: 'DELETE'
            });

            const deleteResult = await deleteResponse.json();
            console.log('Task deleted:', deleteResult);
            fetchTasks(); // Refresh task list

            // Show success message
            Swal.fire({
                icon: 'success',
                title: '¡Profesional Borrado!',
                text: `-"${task.apellido} ${task.nombre}"\n ha sido borrado exitosamente.`,
                timer: 3000,
                showConfirmButton: false
            });
        }
    } catch (error) {
        console.error('Error deleting task:', error);
    }
}

function clearForm() {
    document.getElementById('form_id').value = '';
    
    document.getElementById('form_apellido').value = ''; // Reset status
    document.getElementById('form_nombre').value = ''; // Reset status
    document.getElementById('form_especialidad').value = ''; // Reset status
}
