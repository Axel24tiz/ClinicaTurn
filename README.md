# ClinicaTurn
Índice del Sistema de Turnos Digital para Clínica Ottokrause

Introducción
Descripción General del Sistema de Turnos Digital
Este sistema de turnos digital para la Clínica Ottokrause permite a los usuarios gestionar sus citas médicas de manera eficiente. A través de una interfaz intuitiva, los pacientes pueden buscar médicos por nombre, especialidad y obra social, además de revisar la disponibilidad de horarios y realizar la reserva de turnos.

Objetivo
Simplificar la gestión de citas y horarios dentro de la clínica, automatizando el proceso de búsqueda, reserva, y confirmación de turnos. El sistema permite a los pacientes reservar citas de manera fácil y rápida, mientras que proporciona a los médicos y al personal administrativo una herramienta organizada para la gestión de su agenda.

Alcance
El proyecto se considera completo cuando tanto el médico como el paciente reciben toda la información necesaria del turno:

Paciente: Recibe un correo electrónico de confirmación que incluye detalles básicos del turno, como fecha, hora, y datos del médico.
Médico: Puede acceder a la información del turno desde su interfaz administrativa, donde podrá ver los datos del paciente y organizar su agenda de manera efectiva.

Tecnologías Utilizadas:
Backend: PHP y MySQL.
Servidor: WAMPServer.
Frontend: HTML, CSS y JavaScript.
Estructura del Proyecto

Organización de carpetas y archivos principales.
Explicación de los componentes y modelos.
Guía de Instalación

Requisitos previos (WAMP, PHP, MySQL).
Instrucciones para configurar el entorno.
Pasos para importar la base de datos.
Funcionalidades Principales

Interfaz de Usuario
Buscador de doctores con filtros: Nombre, especialidad y obra social.

![interfaz](https://github.com/user-attachments/assets/b116f56d-b9e5-431f-a683-59d57884e6f3)

Visualización de los doctores disponibles con horarios y botón para agendar turno.

![interfaz](https://github.com/user-attachments/assets/0a0a7d19-8713-41be-8b5d-503747bfba1c)


Sistema de Turnos
Selección de día y horario en un calendario.

![calendario](https://github.com/user-attachments/assets/b3bfff74-45b9-4847-9f76-9ab46de40edd)

Modal de registro del paciente.
Agendamiento y Confirmación de Turno
Registro de datos de paciente (con verificación si ya existe).

![modal](https://github.com/user-attachments/assets/47591d96-2035-42e6-a233-3e6bd69cab13)


Almacenamiento en tablas de turnos y pacientes.
Envío de notificación de confirmación por correo.
Panel Administrativo
Acceso exclusivo para secretaría, director y médicos.
Visualización de citas programadas.

Base de Datos

Tablas principales y relaciones:
Pacientes.
Turnos.
Médicos y Horarios.
Descripción de columnas clave y sus relaciones.
Colores de Disponibilidad en el Calendario

Verde: Día disponible.
Rojo: Día ocupado.
Amarillo: Feriado.
Personalización y Configuración Adicional

Instrucciones para modificar horarios de atención.
Ajuste de notificaciones y plantillas de correo.
Resolución de Problemas Comunes

Preguntas frecuentes sobre errores comunes.
Pasos para verificar problemas de conexión.
Próximas Mejora y Mantenimiento

Lista de características adicionales en consideración.
