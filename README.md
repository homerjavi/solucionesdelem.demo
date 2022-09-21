# Soluciones Delem
## Instalación:
1. **git clone https://github.com/homerjavi/solucionesdelem.demo.git**
2. En la consola accedemos a la carpeta del proyecto
3. **composer install**
4. **cp .env.example .env**
5. Crear base de datos: 
    - Nombre: delem
    - Usuario: root
    - Contraseña: 
6. **php artisan migrate:fresh --seed**
7. **php artisan key:generate**
8. **php artisan storage:link**

En este punto ya tenemos todo instalado, ya solo nos queda iniciar el servicio de base de datos y "levantar" el proyecto con **php artisan serve**

## Apreciaciones
- Como me comentaste que utilizabais Livewire, quise implementarlo en la prueba. Es una herramienta que no me convenció cuando la probé hace ya un tiempo, pero la verdad que es súper interesante, e imagino que aprendiéndola correctamente y dedicándole tiempo será brutal!

- Me hubiera gustado realizar alguna validación adicional al grabar un mensaje del chat, como la de comprobar que el chat_id pertenezca al usuario que está enviando el mensaje o al creador del servicio asociado a ese chat, pero desde Livewire cambia un poco esto y no tuve más tiempo para investigar :(

- Hay seeders que crean dos usuarios y algunos servicios. Los usuarios son:
    - juan@juan.com   - password
    - laura@laura.com - password
